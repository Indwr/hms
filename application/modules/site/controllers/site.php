<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends MX_Controller {

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
        $this->load->model('blog/blog_model');
        $this->load->model('department/department_model');
        $this->load->model('finance/finance_model');
        $this->load->model('settings/settings_model');
        $this->load->model('site_model');
		
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
        $this->lang->load('system_syntax');
		
		$this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->model('ion_auth_model');
		
    }

    public function index() {
		$data['settings'] = $this->settings_model->getSettings();
		$data['blogs'] = $this->blog_model->getBlog();
		$data['departments'] = $this->department_model->getDepartment();
		$data['staffs'] = $this->staff_model->getStaff();
        $this->load->view('site_head', $data);
        $this->load->view('site', $data);
        $this->load->view('site_footer');
    }
	
	public function aboutUs() {
		$data['settings'] = $this->settings_model->getSettings();
		$data['blogs'] = $this->blog_model->getBlog();
		$data['departments'] = $this->department_model->getDepartment();
		$data['staffs'] = $this->staff_model->getStaff();
        $this->load->view('site_head', $data);
        $this->load->view('site_about', $data);
        $this->load->view('site_footer');
    }
	
	function checkOnlineByJason() {
        $data['online_history'] = 'you are online';
        echo json_encode($data);
    }

    public function permission() {
        $this->load->view('permission');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
