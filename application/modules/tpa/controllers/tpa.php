<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tpa extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('staff/staff_model');
        $this->load->model('patient/patient_model');
        $this->load->model('settings/settings_model');
		$this->load->model('sms/sms_model');
		$this->load->model('tpa_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
		 $data = array();
        $data['tpas'] = $this->tpa_model->getTpa();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('tpa', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function addNew() {
		$id = $this->input->post('id');
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $code = $this->input->post('code');
        $contact_phone = $this->input->post('contact_phone');
        $contact_name= $this->input->post('contact_name');
        $email = $this->input->post('email');
        

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('address', 'address', 'trim|xss_clean');
        $this->form_validation->set_rules('code', 'code', 'trim|xss_clean');
        $this->form_validation->set_rules('contact_phone', 'contact_phone', 'trim|xss_clean');
        $this->form_validation->set_rules('contact_email', 'contact_email', 'trim|xss_clean');
        $this->form_validation->set_rules('email', 'email', 'trim|xss_clean');
        
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('tpa');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'name' => $name,
                'address' => $address,
                'code' => $code,
                'contact_phone' => $contact_phone,
                'contact_name' => $contact_name,
                'email' => $email,
                
            );
            if (empty($id)) {
                $this->tpa_model->insertTpa($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->tpa_model->updateTpa($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('tpa');
        }
        
    }
	
	function editTpaByJason() {
        $id = $this->input->get('id');
        $data['tpa'] = $this->tpa_model->getTpaById($id);
        echo json_encode($data);
    }
	
	
	function delete() {
        $id = $this->input->get('id');
        $this->tpa_model->delete($id);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('tpa');
    }


}

/* End of file tpa.php */
/* Location: ./application/modules/tpa/controllers/tpa.php */
