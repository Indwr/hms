<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bloodbank extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('staff/staff_model');
        $this->load->model('patient/patient_model');
        $this->load->model('settings/settings_model');
		$this->load->model('sms/sms_model');
		$this->load->model('bloodbank_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
		 $data = array();
        $data['bloodbanks'] = $this->bloodbank_model->getBloodbank();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('bloodbank', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function addNew() {
		$id = $this->input->post('id');
        $bags = $this->input->post('bags');
        

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('bags', 'Bags', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('bloodbank');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'bags' => $bags,
                
            );
            if (empty($id)) {
                $this->bloodbank_model->insertBloodbank($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->bloodbank_model->updateBloodbank($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('bloodbank');
        }
        
    }
	
	function editBloodbankByJason() {
        $id = $this->input->get('id');
        $data['bloodbank'] = $this->bloodbank_model->getBloodbankById($id);
        echo json_encode($data);
    }
	
	
	public function donor() {
		$data = array();
        $data['bloodbanks'] = $this->bloodbank_model->getBloodbank();
        $data['donors'] = $this->bloodbank_model->getDonor();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('donor', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function addDonor() {
		$id = $this->input->post('id');
        $name = $this->input->post('name');
        $b_group = $this->input->post('b_group');
        $dob = $this->input->post('dob');
        $gender = $this->input->post('gender');
        $d_date = $this->input->post('d_date');
        $phone = $this->input->post('phone');
        

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('b_group', 'b_group', 'trim|xss_clean');
        $this->form_validation->set_rules('gender', 'gender', 'trim|xss_clean');
        $this->form_validation->set_rules('d_date', 'd_date', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('donor');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'name' => $name,
                'gender' => $gender,
                'd_date' => $d_date,
                'b_group' => $b_group,
                'dob' => $dob,
                'phone' => $phone,
                
            );
            if (empty($id)) {
                $this->bloodbank_model->insertDonor($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->bloodbank_model->updateDonor($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('bloodbank/donor');
        }
        
    }
	
	function editDonorByJason() {
        $id = $this->input->get('id');
        $data['donor'] = $this->bloodbank_model->getDonorById($id);
        echo json_encode($data);
    }
	
	
	function delete() {
        $id = $this->input->get('id');
        $this->bloodbank_model->delete($id);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('bloodbank/donor');
    }


}

/* End of file bloodbank.php */
/* Location: ./application/modules/bloodbank/controllers/bloodbank.php */
