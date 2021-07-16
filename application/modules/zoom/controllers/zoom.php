<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Zoom extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('staff/staff_model');
        $this->load->model('patient/patient_model');
        $this->load->model('settings/settings_model');
		$this->load->model('sms/sms_model');
		$this->load->model('zoom_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
		$data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('zoom', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function meeting() {
		$data['meetings'] = $this->zoom_model->getZoomMeeting();
		$data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('list_meeting', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	
    public function myZoomCredential() {
		$doctor_ion_id = $this->ion_auth->get_user_id();
	    $data['doctor'] = $this->db->get_where('staff', array('ion_user_id' => $doctor_ion_id))->row();
		$data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('myZoomCredential', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	
	
	function zoomMeeting() {
        $data = array();
        $live_id = $this->input->get('zoom_meeting_soft');
        $meeting_id = $this->input->get('zoom_meeting_token');
		
        $live_details = $this->db->get_where('meeting', array('id' => $live_id))->row();
		
        $data['meeting_id'] = $live_details->meeting_id;
        $data['live_id'] = $live_details->id;
        $data['meeting_password'] = $live_details->meeting_password;
        $doctor_ion_id = $live_details->doctor_ion_id;
		
        $settings = $this->db->get_where('staff', array('ion_user_id' => $doctor_ion_id))->row();
        $data['api_key'] = $settings->api_key;
        $data['api_secret'] = $settings->api_secret;

        if ($meeting_id == $live_details->meeting_id) {
            $this->load->view('meeting', $data);
        } else {
          $this->session->set_flashdata('feedback', 'Invalid Zoom Meeting Token');
           redirect('zoom/meeting');
        }
    }
	
	
	public function updateZoomCredential() {
		$id = $this->input->post('id');
		$api_key = $this->input->post('api_key');
		$api_secret = $this->input->post('api_secret');
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category api_key Field
        $this->form_validation->set_rules('api_key', 'api_key', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('zoom/myZoomCredential');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'api_key' => $api_key,
                'api_secret' => $api_secret
            );
			$this->zoom_model->updateZoom($id, $data);
			$this->session->set_flashdata('feedback', 'Updated');
            redirect('zoom/myZoomCredential');
        }
        
    }
	
	
	

}

/* End of file zoom.php */
/* Location: ./application/modules/zoom/controllers/zoom.php */
