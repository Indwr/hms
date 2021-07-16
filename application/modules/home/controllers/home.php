<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('ion_auth_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('patient/patient_model');
        $this->load->model('staff/staff_model');
        $this->load->model('finance/finance_model');
        $this->load->model('bed/bed_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('settings/settings_model');
        $this->load->model('home_model');
		
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
        $this->lang->load('system_syntax');
		
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
		
		
    }

    public function index() {
		
		if ($this->ion_auth->in_group(array('Patient'))) {
			redirect('home/myDetails');
		}
		
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['sum'] = $this->home_model->getSum('gross_total', 'payment');
        $data['payments'] = $this->finance_model->getPayment();
		
		$data['this_month'] = $this->finance_model->getThisMonth();
        $data['expenses'] = $this->finance_model->getExpense();
		
		
		$data['categories'] = $this->finance_model->getPaymentCategory();
        $data['patients'] = $this->patient_model->getPatient();
        $this->load->view('dashboard', $data); // just the header file
        $this->load->view('home', $data);
        $this->load->view('footer');
    }
	
	public function myDetails() {
		$patient_ion_id = $this->ion_auth->get_user_id();
		$patientt = $this->db->get_where('patient', array('ion_user_id' => $patient_ion_id))->row()->id;
							
        $data = array();
        $data['patient'] = $this->patient_model->getPatientById($patientt);
        $data['admissions'] = $this->patient_model->getAdmission();
        $data['medical_historys'] = $this->patient_model->getMedicalHistory();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['beds'] = $this->bed_model->getBed();
        $data['documents'] = $this->patient_model->getDocument();
        $data['appointments'] = $this->appointment_model->getAppointment();
        $data['payments'] = $this->finance_model->getPayment();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('patient_history_own', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	

    public function permission() {
        $this->load->view('permission');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
