<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staff extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('staff_model');
        $this->load->model('settings/settings_model');
        $this->load->model('patient/patient_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('department/department_model');
        $this->load->model('finance/finance_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
       
    }

    public function index() {
        $data['staffs'] = $this->staff_model->getStaff();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('staff', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function staffPermission() {
        $data['staffs'] = $this->staff_model->getStaff();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('staff_permit', $data);
        $this->load->view('home/footer'); // just the header file
    }

	
	public function addStaff() {
		$data['settings'] = $this->settings_model->getSettings();
		$data['departments'] = $this->department_model->getDepartment();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('addStaff');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $permission = $this->input->post('permission');
        $profile = $this->input->post('profile');
        $dept = $this->input->post('dept');
		
		$permission = implode(',', $permission);
		
		if($profile === 'Admin'){
			$permission = 'patient,medical history,bed,tpa,appointment,human resources,bloodbank,pharmacy,notice,report,ambulance,inventory,finance,financial report,leave,sms,blog,settings';
		} else {
			$permission = $this->input->post('permission');
			$permission = implode(',', $permission);
		}

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                 $this->load->view('staff/addNew');
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new');
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $file_name = $_FILES['img_url']['name'];
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 1;
            foreach ($file_name_pieces as $piece) {
                if ($count !== 1) {
                    $piece = ucfirst($piece);
                }
                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1768",
                'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'permission' => $permission,
					'profile' => $profile,
                    'dept' => $dept,
                    'phone' => $phone
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
					'permission' => $permission,
                    'profile' => $profile,
					'dept' => $dept,
                    'phone' => $phone
                );
            }
            $username = $this->input->post('name');
            if (empty($id)) {     // Adding New Staff
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', 'This Email Address Is Already Registered');
                    $this->load->view('staff');
                } else {
                    $dfg = 6;
                    $this->ion_auth->register($username, $password, $email, $dfg);
					$ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
					$this->staff_model->insertStaff($data);
					$staff_user_id = $this->db->get_where('staff', array('email' => $email))->row()->id;
					$id_info = array('ion_user_id' => $ion_user_id);
					$this->staff_model->updateStaff($staff_user_id, $id_info);
					$this->session->set_flashdata('feedback', 'Added');
                }
            } else { // Updating Staff
                $ion_user_id = $this->db->get_where('staff', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->staff_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->staff_model->updateStaff($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('staff');
        }
    }

    function getStaff() {
        $data['staffs'] = $this->staff_model->get_staff();
        $this->load->view('staff', $data);
    }

    function editStaffById() {
        $data = array();
        $id = $this->input->get('id');
		$data['departments'] = $this->department_model->getDepartment();
        $data['staff'] = $this->staff_model->getStaffById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('addStaff', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	
	function doctorDetails() {
        $data = array();
        $id = $this->input->get('id');
        $doctorHistory = $this->input->get('doctorHistory');
	 if ($doctorHistory == '5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1'){
		$data['departments'] = $this->department_model->getDepartment();
		$data['appointments'] = $this->appointment_model->getAppointment();
		$data['settings'] = $this->settings_model->getSettings();
		$data['payments'] = $this->finance_model->getPayment();
        $data['staff'] = $this->staff_model->getStaffById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('doctor_details', $data);
        $this->load->view('home/footer'); // just the footer file
	 }
    }
	
	function myDetails() {
        $data = array();
		$staff_ion_id = $this->ion_auth->get_user_id();
	    $staff = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->id;
		
		$data['departments'] = $this->department_model->getDepartment();
		$data['appointments'] = $this->appointment_model->getAppointment();
		$data['settings'] = $this->settings_model->getSettings();
		$data['payments'] = $this->finance_model->getPayment();
        $data['staff'] = $this->staff_model->getStaffById($staff);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('doctor_details', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	
	function editStaff() {
        $data = array();
        $id = $this->input->get('id');
		$data['departments'] = $this->department_model->getDepartment();
        $data['staff'] = $this->staff_model->getStaffById($id);
        $data['staffs'] = $this->staff_model->getStaff();
		$data['settings'] = $this->settings_model->getSettings();
		$data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('addStaff', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	
	

    function editStaffByJason() {
        $id = $this->input->get('id');
        $data['staff'] = $this->staff_model->getStaffById($id);
        echo json_encode($data);
    }
	
	function getPermitByAjax() {
        $id = $this->input->get('id');
        $data['staff'] = $this->staff_model->getStaffById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('staff', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->staff_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('staff');
    }

}

/* End of file staff.php */
/* Location: ./application/modules/staff/controllers/staff.php */
