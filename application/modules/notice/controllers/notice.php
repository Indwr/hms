<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notice extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('staff/staff_model');
        $this->load->model('patient/patient_model');
        $this->load->model('settings/settings_model');
		$this->load->model('sms/sms_model');
		$this->load->model('notice_model');
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
		
			if (in_array('notice', $permission1) == false) {
				redirect('notice/notices');
			}
			
		} 		
		
		$data = array();
        $data['notices'] = $this->notice_model->getNotice();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('notice', $data);
        $this->load->view('home/footer'); // just the header file
    } 
	
	public function notices() {
		
		$data = array();
        $data['notices'] = $this->notice_model->getNotice();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('notices_others', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function addNew() {
		$id = $this->input->post('id');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $user = $this->input->post('user');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        
		
		$user = implode(',', $user);

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('title', 'Title', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('notice');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'title' => $title,
                'user' => $user,
                'description' => $description,
                'from_date' => $from_date,
                'to_date' => $to_date,
                
            );
            if (empty($id)) {
                $this->notice_model->insertNotice($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->notice_model->updateNotice($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('notice');
        }
        
    }
	
	function editNotice() {
        $data = array();
        $id = $this->input->get('id');
		$data['notices'] = $this->notice_model->getNotice();
        $data['notice'] = $this->notice_model->getNoticeById($id);
        $data['staffs'] = $this->staff_model->getStaff();
		$data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('notice_edit', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	
	function viewNotice() {
        $data = array();
        $id = $this->input->get('id');
		$data['notices'] = $this->notice_model->getNotice();
        $data['notice'] = $this->notice_model->getNoticeById($id);
        $data['staffs'] = $this->staff_model->getStaff();
		$data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('notice_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	
	
	function editNoticeByJason() {
        $id = $this->input->get('id');
        $data['notice'] = $this->notice_model->getNoticeById($id);
        echo json_encode($data);
    }
	
	
	function delete() {
        $id = $this->input->get('id');
        $this->notice_model->delete($id);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('notice');
    }


}

/* End of file notice.php */
/* Location: ./application/modules/notice/controllers/notice.php */
