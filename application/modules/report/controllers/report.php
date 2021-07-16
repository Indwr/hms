<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('staff/staff_model');
        $this->load->model('patient/patient_model');
        $this->load->model('settings/settings_model');
		$this->load->model('sms/sms_model');
		$this->load->model('report_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
		 $data = array();
        $data['reports'] = $this->report_model->getReport();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['patients'] = $this->patient_model->getPatient();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('report', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	
	
	public function addNew() {
		$id = $this->input->post('id');
        $type = $this->input->post('type');
        $description = $this->input->post('description');
        $patient = $this->input->post('patient');
        $doctor = $this->input->post('doctor');
        $date = $this->input->post('date');
        $death_cause = $this->input->post('death_cause');
        

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('death_cause', 'death_cause', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('report');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'death_cause' => $death_cause,
                'description' => $description,
                'patient' => $patient,
                'doctor' => $doctor,
                'date' => $date,
                'type' => $type,
                'death_cause' => $death_cause,
                
            );
            if (empty($id)) {
                $this->report_model->insertReport($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->report_model->updateReport($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('report');
        }
        
    }
	
	function editReportByJason() {
        $id = $this->input->get('id');
        $data['report'] = $this->report_model->getReportById($id);
        echo json_encode($data);
    }
	
	
	function delete() {
        $id = $this->input->get('id');
        $this->report_model->delete($id);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('report');
    }


}

/* End of file report.php */
/* Location: ./application/modules/report/controllers/report.php */
