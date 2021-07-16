<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class leave extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('staff/staff_model');
        $this->load->model('patient/patient_model');
        $this->load->model('settings/settings_model');
		$this->load->model('sms/sms_model');
		$this->load->model('leave_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
		
		if ($this->ion_auth->in_group(array('Staff'))) {
		$staff_ion_id = $this->ion_auth->get_user_id();
		$staff = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->id;
		$staff_profile = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
		$permissions = $this->staff_model->getStaffById($staff)->permission;
		$permission1 = explode(',', $permissions);
		
			if (in_array('leave', $permission1) == false) {
				redirect('leave/leaves');
			}
			
		} 		
		
		$data = array();
        $data['leaves'] = $this->leave_model->getleave();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('leave', $data);
        $this->load->view('home/footer'); // just the header file
    } 
	
	public function leaves() {
		
		$data = array();
        $data['leaves'] = $this->leave_model->getleave();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('leave_others', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function addNew() {
		$id = $this->input->post('id');
        $description = $this->input->post('description');
        $from_date = $this->input->post('from_day');
        $to_date = $this->input->post('to_day');
        $type = $this->input->post('type');
		
		$staff_ion_id = $this->ion_auth->get_user_id();
		$staff = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->id;
        

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('leave');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'staff' => $staff,
                'description' => $description,
                'from_day' => $from_date,
                'to_day' => $to_date,
                'type' => $type,
                
            );
            if (empty($id)) {
                $this->leave_model->insertleave($data);
                $this->session->set_flashdata('feedback', 'Leave Applied');
            } else {
                $this->leave_model->updateleave($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('leave/leaves');
        }
        
    }
	
	function editleave() {
        $data = array();
        $id = $this->input->get('id');
		$data['leaves'] = $this->leave_model->getleave();
        $data['leave'] = $this->leave_model->getleaveById($id);
        $data['staffs'] = $this->staff_model->getStaff();
		$data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('leave_edit', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	
	function viewleave() {
        $data = array();
        $id = $this->input->get('id');
		$data['leaves'] = $this->leave_model->getleave();
        $data['leave'] = $this->leave_model->getleaveById($id);
        $data['staffs'] = $this->staff_model->getStaff();
		$data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('leave_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	
	
	function editleaveByJason() {
        $id = $this->input->get('id');
        $data['leave'] = $this->leave_model->getleaveById($id);
        echo json_encode($data);
    }
	
	
	function approve() {
        $id = $this->input->get('id');
		$data = array();
		$data = array(
			'status' => 'approved',
			);
        $this->leave_model->updateleave($id, $data);
        $this->session->set_flashdata('feedback', 'Leave Approved');
        redirect('leave');
    }
	
	function decline() {
        $id = $this->input->get('id');
		$data = array();
		$data = array(
			'status' => 'declined',
			);
        $this->leave_model->updateleave($id, $data);
        $this->session->set_flashdata('feedback', 'Leave Approved');
        redirect('leave');
    }
	
	function delete() {
        $id = $this->input->get('id');
        $this->leave_model->delete($id);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('leave');
    }


}

/* End of file leave.php */
/* Location: ./application/modules/leave/controllers/leave.php */
