<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patient extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('patient_model');
		$this->load->model('staff/staff_model');
		$this->load->model('sms/sms_model');
		$this->load->model('tpa/tpa_model');
		$this->load->model('bed/bed_model');
		$this->load->model('finance/finance_model');
		$this->load->model('appointment/appointment_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('settings/settings_model');
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
        $data['patients'] = $this->patient_model->getPatient();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['beds'] = $this->bed_model->getBed();
        $data['tpas'] = $this->tpa_model->getTpa();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('patient', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function myPatient() {
        $data['patients'] = $this->patient_model->getPatient();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['beds'] = $this->bed_model->getBed();
        $data['tpas'] = $this->tpa_model->getTpa();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('patient_doctor', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function patientTodayBirthday() {
        $data['patients'] = $this->patient_model->getPatient();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('patient_bday', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function admit() {
		$patient = $this->input->post('id');
		$bed = $this->input->post('bed');
		$dd_date = $this->input->post('dd_date');
		$a_date = $this->input->post('a_date');
		$doctor = $this->input->post('doctor');
		$tpa = $this->input->post('tpa');
		$policy_no = $this->input->post('policy_no');
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('patient', 'patient', 'trim|xss_clean');
        $this->form_validation->set_rules('bed', 'bed', 'trim|xss_clean');
        $this->form_validation->set_rules('dd_date', 'dd_date', 'trim|xss_clean');
        $this->form_validation->set_rules('a_date', 'a_date', 'trim|xss_clean');
        // Validating Description Field
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('patient');
            $this->load->view('home/footer'); // just the header file
        } else {
			
			
            $previous_admit = $this->db->get_where('patient', array('id' => $patient))->row()->admit;
            $new_admit = $previous_admit + '1';
			$data1 = array();
            $data1 = array(
                'admit_to' => $dd_date,
                'admit_from' => $a_date,
                'admit' => $new_admit,
                'bed' => $bed,
			);
			$this->patient_model->updatePatient($patient, $data1);
			
			$user_ion_id_1 = $this->ion_auth->get_user_id();
			$stafff = $this->db->get_where('staff', array('ion_user_id' => $user_ion_id_1))->row()->id;
            if ($this->ion_auth->in_group(array('Staff'))) {
				$paid_user = $stafff;
			} else{
				$paid_user = 'Administrator';
			}
			
			$dis_date = str_replace("-","",$dd_date);
			$adds_date = str_replace("-","",$a_date);
			
			$dis_date1 = strtotime($dis_date);
			$adds_date1 = strtotime($adds_date);
			$datediff = $dis_date1 - $adds_date1;
			$no_of_days = round($datediff / (60 * 60 * 24));
			
			if($no_of_days == '0'){
			   $no_of_days = '1';
			} else{
			   $no_of_days;
			}
			
			$bed_price = $this->db->get_where('bed', array('id' => $bed))->row()->fee;
			$bed_name = $this->db->get_where('bed', array('id' => $bed))->row()->name;
            $bed_price_payment = $bed_price * $no_of_days;
			$category_name = 'Payment for ' .  $bed_name . ' bed for ' . $no_of_days . ' days';
			$data = array(
				'category' => $category_name,
				'patient' => $patient,
				'date' => $adds_date1,
				'amount' => $bed_price_payment,
				'gross_total' => $bed_price_payment,
				'user' => $paid_user,
				'bed_qty' => $no_of_days . ' days',
				'hospital_amount' => $bed_price_payment,
				'status' => 'unpaid',
				'bed_unit' => $bed_price,
				
			);
            $this->finance_model->insertPayment($data);
			
			
			$data1 = array();
            $data1 = array(
                'patient' => $patient,
                'bed' => $bed,
                'dd_date' => $dd_date,
                'a_date' => $a_date,
                'policy_no' => $policy_no,
                'tpa' => $tpa,
                'doctor' => $doctor,
                'days' => $no_of_days,
            );
			$this->patient_model->insertAdmission($data1);
			
			$data1 = array();
            $data1 = array(
                'last_a_time' => $a_date,
                'last_d_time' => $dd_date,
            );
			$this->bed_model->updateBed($bed, $data1);
			
			$data = array();
            $data = array(
                'patient' => $patient,
                'bed' => $bed,
                'dd_date' => $dd_date,
                'a_date' => $a_date,
            );
            $this->bed_model->insertAllotedBed($data);
			$this->session->set_flashdata('feedback', 'Patient Admitted');	
            redirect('patient');
        }
        
    } 

    public function addNew() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $sex = $this->input->post('sex');
        $patient_id = $this->input->post('p_id');
        $dob = $this->input->post('dob');
        $b_group = $this->input->post('b_group');
        $doctor = $this->input->post('doctor');
        $photo = $this->input->post('photo');
        $img_url = $this->input->post('img_url');
        if (empty($patient_id)) {
            $patient_id = rand(10000, 1000000);
        }
		
		if (empty($email)) {
            $email = $name . '@omnimedy.com';
        }
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('patient', array('id' => $id))->row()->add_date;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|min_length[5]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[2]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[2]|max_length[50]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('sex', 'Sex', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("patient/editPatient?id=$id");
            } else {
                $data = array();
                $data['settings'] = $this->settings_model->getSettings();
                 redirect("patient");
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
                    'patient_id' => $patient_id,
                    'img_url' => $img_url,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                    'sex' => $sex,
                    'add_date' => $add_date,
                    'b_group' => $b_group,
                    'doctor' => $doctor,
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'patient_id' => $patient_id,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
					'img_url' => $photo,
                    'phone' => $phone,
                    'sex' => $sex,
                    'dob' => $dob,
                    'add_date' => $add_date,
                    'b_group' => $b_group,
                    'doctor' => $doctor,
                );
            }

            $username = $this->input->post('name');
            if (empty($id)) {     // Adding New Patient
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', 'This Email Address Is Already Registered');
                    redirect('patient');
                } else {
                    $dfg = 5;
                    $this->ion_auth->register($username, $password, $email, $dfg);
					$ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
					$this->patient_model->insertPatient($data);
				    $patient_user_id = $this->db->get_where('patient', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->patient_model->updatePatient($patient_user_id, $id_info);
                    $this->session->set_flashdata('feedback', 'Added');
                }
            } else { // Updating Patient
                $ion_user_id = $this->db->get_where('patient', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->patient_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->patient_model->updatePatient($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('patient');
        }
    }

    function getPatient() {
        $data['patient'] = $this->patient_model->get_patient();
        $this->load->view('patient', $data);
    }

    function editPatient() {
        $data = array();
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	
	function patientHistory() {
        $data = array();
        $id = $this->input->get('id');
        $history_token = $this->input->get('history_token');
		if($history_token == '5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1'){
        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['admissions'] = $this->patient_model->getAdmission();
        $data['medical_historys'] = $this->patient_model->getMedicalHistory();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['beds'] = $this->bed_model->getBed();
        $data['documents'] = $this->patient_model->getDocument();
        $data['appointments'] = $this->appointment_model->getAppointment();
        $data['payments'] = $this->finance_model->getPayment();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('patient_history', $data);
        $this->load->view('home/footer'); // just the footer file
		}
    }
	
	public function addMedicalHx() {
		$id = $this->input->post('id');
        $date = $this->input->post('date');
        $case_history = $this->input->post('case_history');
        $exam_find = $this->input->post('exam_find');
        $dx = $this->input->post('dx');
        $patient = $this->input->post('patient');
        

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('exam_find', 'exam_find', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('department');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'date' => $date,
                'exam_find' => $exam_find,
                'case_history' => $case_history,
                'dx' => $dx,
                'patient' => $patient,
                
            );
            if (empty($id)) {
                $this->patient_model->insertMedicalHx($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->patient_model->updateMedicalHx($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('patient/patientHistory?id=' . $patient . '&history_token=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1');
        }
        
    }
	
	public function rxModalHistory() {
		$id = $this->input->post('id');
		$patient = $this->input->post('patient');
        $rx = $this->input->post('rx');
        
		$data = array();
		$data = array(
			'rx' => $rx,
		);
		$this->patient_model->updateMedicalHx($id, $data);
		$this->session->set_flashdata('feedback', 'Prescription Updated');
		redirect('patient/patientHistory?id=' . $patient . '&history_token=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1');
    }
	
	function amountReceivedFromCT() {
        $id = $this->input->post('id');
        $amount_received = $this->input->post('amount_received');
        $payments = $this->finance_model->getPaymentByPatientId($id);
		$patient = $this->input->post('patient');
        foreach ($payments as $payment) {
            if ($payment->gross_total != $payment->amount_received) {
                $due_balance = $payment->gross_total - $payment->amount_received;
                if ($amount_received <= $due_balance) {
                    $data = array();
                    $new_amount_received = $amount_received + $payment->amount_received;
                    $data = array('amount_received' => $new_amount_received);
                    $this->finance_model->amountReceived($payment->id, $data);
                    break;
                } else {
                    $data = array();
                    $new_amount_received = $due_balance + $payment->amount_received;
                    $data = array('amount_received' => $new_amount_received);
                    $this->finance_model->amountReceived($payment->id, $data);
                    $amount_received = $amount_received - $due_balance;
                }
            }
        }
		$this->session->set_flashdata('feedback', 'Due Amount Cleared');
		redirect('patient/patientHistory?id=' . $patient . '&history_token=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1');
    }
	
	function addPatientDocument() {
        $title = $this->input->post('title');
        $patient_id = $this->input->post('patient');
        $img_url = $this->input->post('img_url');
 
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', 'Validation Error !');
            redirect($redirect);
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
                'allowed_types' => "*",
                'overwrite' => False,
                'max_size' => "2048000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1768000",
                'max_width' => "2024000"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'name' => $title,
                    'patient' => $patient_id,
                    'date' => time(),
                );
            } else {
                $this->session->set_flashdata('feedback', 'Upload Error !');
		        redirect('patient/patientHistory?id=' . $patient_id . '&history_token=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1');
        
            }

		$this->patient_model->insertDocument($data);
		$this->session->set_flashdata('feedback', 'Document Added');
		redirect('patient/patientHistory?id=' . $patient_id . '&history_token=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1');
        }
    }
	
	
	function addPatientDocumentByPatient() {
        $title = $this->input->post('title');
        $patient_id = $this->input->post('patient');
        $img_url = $this->input->post('img_url');
 
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', 'Validation Error !');
            redirect($redirect);
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
                'allowed_types' => "*",
                'overwrite' => False,
                'max_size' => "2048000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1768000",
                'max_width' => "2024000"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'name' => $title,
                    'patient' => $patient_id,
                    'date' => time(),
                );
            } else {
                $this->session->set_flashdata('feedback', 'Upload Error !');
		        redirect('home/myDetails');
        
            }

		$this->patient_model->insertDocument($data);
		$this->session->set_flashdata('feedback', 'Document Added');
		redirect('home/myDetails');
        }
    }
	
	public function patientSearch() {
        $data = array();
        $search = $this->input->post('patient_name');
        $data['patients'] = $this->patient_model->getPatient();
        $data['search'] = $search;
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('patient_search', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editPatientByJason() {
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        echo json_encode($data);
    }
	
	function editMedicalHxByJason() {
        $id = $this->input->get('id');
        $data['MedicalHx'] = $this->patient_model->getMedicalHxById($id);
        echo json_encode($data);
    }

    function patientDetails() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['patient'] = $this->patient_model->getPatientById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('patient', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->patient_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('patient');
    }

	function deleteMedicalHistory() {
        $id = $this->input->get('id');
        $patient = $this->input->get('patient');
        $this->patient_model->deleteMedicalHistory($id);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('patient/patientHistory?id=' . $patient . '&history_token=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1');
    }
	
	
	
	function sendWishes() {

		$smsSettings = $this->sms_model->getSmsSettings();
	
		$sender = $smsSettings->sender;
	    $api_id = $smsSettings->api_id;
	    $username = $smsSettings->username;
		$password = $smsSettings->password;
		
		$patient = $this->input->post('id');
		$mobiles = $this->input->post('phone');
		
				
		$message = $this->input->post('message');
		$message1 = urlencode($message);
		$send_now = file_get_contents('https://api.clickatell.com/http/sendmsg?user=' . $username . '&password=' . $password . '&api_id=' . $api_id . '&to=' . $mobiles . '&text=' . $message1);
		
						
		if ($send_now) {			
			$data = array();
			$data = array(
						'date' => time(),
						'year' => date('Y'),
						'patient' => $patient,
						'message' => $message,
					);
			$this->patient_model->insertSendWishes($data);
            $this->session->set_flashdata('feedback', 'Wishes Sent');
			redirect('patient/patientTodayBirthday');
        } else {
            $this->session->set_flashdata('feedback', 'Wishes Not Sent');
			redirect('patient/patientTodayBirthday');
        }
		
	}


}

/* End of file patient.php */
    /* Location: ./application/modules/patient/controllers/patient.php */
    