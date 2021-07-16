<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sms extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('staff/staff_model');
        $this->load->model('patient/patient_model');
        $this->load->model('settings/settings_model');
		$this->load->model('sms_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
		$patient_check = $this->settings_model->getSettings();
		if($patient_check->patient_sales == 'off') {
			redirect('home');
		} 
    }

    public function index() {
        $data['staffs'] = $this->staff_model->getStaff();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('staff', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function settings() {
        $data = array();
        $id = $this->ion_auth->get_user_id();
		$data['settings'] = $this->settings_model->getSettings();
        $data['settings_sms'] = $this->sms_model->getSmsSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('settings', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	
	public function addNewSettings() {
        $id = $this->input->post('id');
        $sender = $this->input->post('sender');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('sender', 'sender', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field
        if (!empty($password)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $id = $this->ion_auth->get_user_id();
            $data['sms'] = $this->sms_model->getSmsSettingsById($id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('settings', $data);
            $this->load->view('home/footer'); // just the footer file
        } else {
            $data = array();
            $data = array(
                'sender' => $sender,
                'username' => $username,
                'password' => $password,
                'user' => $this->ion_auth->get_user_id()
            );
            if (empty($this->sms_model->getSmsSettingsById($id)->username)) {
                $this->sms_model->addSmsSettings($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->sms_model->updateSmsSettings($data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('sms/settings');
        }
    }
	
	public function betaSMSsendNew(){
		$smsSettings = $this->sms_model->getSmsSettings();
		$sender = $smsSettings->sender;
	    $username = $smsSettings->username;
		$password = $smsSettings->password;
		
		$message = $this->input->post('message');
		$mobiles = $this->input->post('mobiles');
		
		header("Access-Control-Allow-Origin: *");
	
	    //rebuild form data
		$postdata = http_build_query( 
				array( 
					'username' => $username,
					'password' => $password,
					'sender' => $sender,
					'mobiles' => $mobiles,
					'message' => $message,	
					)
				);
						
		$r_patient = $this->input->post('mobiles');		
		$patient_detail = $this->db->get_where('patient', array('phone' => $r_patient))->row(); 
		$recipient = 'Patient Name: ' . $patient_detail->name . '<br> Patient Phone: ' . $patient_detail->phone;
					
		$data = array( 
					'mobiles' => $mobiles,
					'message' => $message,	
					'date' => time(),
					'recipient' => $recipient,
				);
				
		//prepare a http post request
		$opts = array('http' =>
				array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $postdata
				)
		);
		
        //craete a stream to communicate with betasms api
		$context  = stream_context_create($opts);
		
		//get result from communication
       $result = file_get_contents('http://login.betasms.com/api/', false, $context);
		
		//return result to client, this will return the appropriate respond code
		//echo $result;
		
		//message to be sent to user
		if ($result == 1701){
			$result = file_get_contents('http://login.betasms.com/api/', false, $context);
			$this->sms_model->insertSms($data);
			$this->session->set_flashdata('feedback', 'Message Sent');	
			redirect('sms/sent');	
		} elseif ($result == 1702){
			$result = file_get_contents('http://login.betasms.com/api/', false, $context);
			$this->session->set_flashdata('feedback', 'Invalid Username or Password');
			redirect('sms/sendNewText');	
		} elseif ($result == 1704 || $result == 1025){
			$result = file_get_contents('http://login.betasms.com/api/', false, $context);
			$this->session->set_flashdata('feedback', 'Insufficient Credit');
			redirect('sms/sendNewText');	
		} else{
			$result = file_get_contents('http://login.betasms.com/api/', false, $context);
			$this->session->set_flashdata('feedback', 'Message Not Sent');
			redirect('sms/sendNewText');	
		}
		redirect('sms/sendNewText');		
	}		
	
	
	
	
	public function sendNew(){
		
		$smsSettings = $this->sms_model->getSmsSettings();
		$sender = $smsSettings->sender;
	    $api_id = $smsSettings->api_id;
	    $username = $smsSettings->username;
		$password = $smsSettings->password;
		
		$mobiles = $this->input->post('mobiles');
		
				
		$message = $this->input->post('message');
		$message1 = urlencode($message);
		$send_now = file_get_contents('https://api.clickatell.com/http/sendmsg?user=' . $username . '&password=' . $password . '&api_id=' . $api_id . '&to=' . $mobiles . '&text=' . $message1);
		
						
		$r_patient = $this->input->post('mobiles');		
		$patient_detail = $this->db->get_where('patient', array('phone' => $r_patient))->row(); 
		$recipient = 'Patient Name: ' . $patient_detail->name . '<br> Patient Phone: ' . $patient_detail->phone;
		
		if ($send_now) {			
			$data = array( 
					'mobiles' => $mobiles,
					'message' => $message,	
					'date' => time(),
					'recipient' => $recipient,
				);
			$this->sms_model->insertSms($data);
            $this->session->set_flashdata('feedback', 'SMS Sent');
			redirect('sms/sent');
        } else {
            $this->session->set_flashdata('feedback', 'SMS not Sent');
			redirect('sms/sendNewText');
        }
		redirect('sms/sendNewText');		
	}		

   public function sendNewText() {
		$data['patients'] = $this->patient_model->getPatient();
		$data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('sendview', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	
	
	
	function sent() {
		$data['settings'] = $this->settings_model->getSettings();
        $data['sents'] = $this->sms_model->getSms();
        $this->load->view('home/dashboard', $data);
        $this->load->view('sms', $data);
        $this->load->view('home/footer');
    }

    function delete() {
        $id = $this->input->get('id');
        $this->sms_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('sms/sent');
    }

}

/* End of file staff.php */
/* Location: ./application/modules/staff/controllers/staff.php */
