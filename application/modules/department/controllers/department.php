<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('staff/staff_model');
        $this->load->model('patient/patient_model');
        $this->load->model('settings/settings_model');
		$this->load->model('sms/sms_model');
		$this->load->model('department_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
		 $data = array();
        $data['departments'] = $this->department_model->getDepartment();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('department', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function addNew() {
		$id = $this->input->post('id');
        $dept = $this->input->post('dept');
        $description = $this->input->post('description');
        

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('dept', 'Department', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('department');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'dept' => $dept,
                'description' => $description
                
            );
            if (empty($id)) {
                $this->department_model->insertDepartment($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->department_model->updateDepartment($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('department');
        }
        
    }
	
	function editDepartmentByJason() {
        $id = $this->input->get('id');
        $data['department'] = $this->department_model->getDepartmentById($id);
        echo json_encode($data);
    }
	
	
	function delete() {
        $id = $this->input->get('id');
        $this->department_model->delete($id);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('department');
    }


}

/* End of file department.php */
/* Location: ./application/modules/department/controllers/department.php */
