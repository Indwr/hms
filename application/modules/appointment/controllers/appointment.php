<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Appointment extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('staff/staff_model');
        $this->load->model('patient/patient_model');
        $this->load->model('settings/settings_model');
		$this->load->model('sms/sms_model');
		$this->load->model('zoom/zoom_model');
		$this->load->model('appointment_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('ion_auth_model');
		$staff_ion_id = $this->ion_auth->get_user_id();
		
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
		if (!$this->ion_auth->in_group(array('Patient')) ) {	
		if ($this->ion_auth->in_group(array('Staff')) ) {	
		
		$staff_ion_id = $this->ion_auth->get_user_id();
		$staff = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->id;
		$check_doctor = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
		$staff_profile = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
		$permissions = $this->staff_model->getStaffById($staff)->permission;
		$permission1 = explode(',', $permissions);
		
		if (in_array('appointment', $permission1) == false && $check_doctor != 'Doctor') {
			redirect('appointment/myAppointment');
		} 
		
		$data = array();
        $data['appointments'] = $this->appointment_model->getAppointment();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['patients'] = $this->patient_model->getPatient();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('appointment', $data);
        $this->load->view('home/footer'); // just the header file
		} else {
			
		$data = array();
        $data['appointments'] = $this->appointment_model->getAppointment();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['patients'] = $this->patient_model->getPatient();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('appointment', $data);
        $this->load->view('home/footer'); // just the header file
			
		}
		}
		if ($this->ion_auth->in_group(array('Patient')) ) {
			redirect('appointment/mineAppointment');
		}
		
    }
	
	public function myAppointment() {
		$staff_ion_id = $this->ion_auth->get_user_id();
		$check_doctor = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
		if ($check_doctor != 'Doctor') {
			redirect('home/permission');
		}
		$data = array();
        $data['appointments'] = $this->appointment_model->getAppointment();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['patients'] = $this->patient_model->getPatient();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('appointment_doctor', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function mineAppointment() {
		$data = array();
        $data['appointments'] = $this->appointment_model->getAppointment();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['patients'] = $this->patient_model->getPatient();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('appointment_patient', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function addNew() {
		$id = $this->input->post('id');
		$patient = $this->input->post('patient');
		$doctor = $this->input->post('doctor');
        $description = $this->input->post('description');
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $department = $this->db->get_where('staff', array('id' => $doctor))->row()->dept;

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('dept', 'Appointment', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('appointment');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'patient' => $patient,
                'doctor' => $doctor,
                'date' => $date,
                'description' => $description,
                'department' => $department,
                'time' => $time,
                
            );
            if (empty($id)) {
                $this->appointment_model->insertAppointment($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->appointment_model->updateAppointment($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('appointment');
        }
        
    }
	
	public function addNewPatient() {
		$id = $this->input->post('id');
		$patient = $this->input->post('patient');
		$doctor = $this->input->post('doctor');
        $description = $this->input->post('description');
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $department = $this->db->get_where('staff', array('id' => $doctor))->row()->dept;

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('dept', 'Appointment', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('appointment');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'patient' => $patient,
                'doctor' => $doctor,
                'date' => $date,
                'description' => $description,
                'department' => $department,
                'time' => $time,
                
            );
            if (empty($id)) {
                $this->appointment_model->insertAppointment($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->appointment_model->updateAppointment($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('patient/patientHistory?id=' . $patient . '&history_token=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1');
        }
        
    }
	
	
	public function addNewByPatientOwn() {
		$id = $this->input->post('id');
		$patient = $this->input->post('patient');
		$doctor = $this->input->post('doctor');
        $description = $this->input->post('description');
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $department = $this->db->get_where('staff', array('id' => $doctor))->row()->dept;

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('dept', 'Appointment', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('appointment');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'patient' => $patient,
                'doctor' => $doctor,
                'date' => $date,
                'description' => $description,
                'department' => $department,
                'time' => $time,
                
            );
            if (empty($id)) {
                $this->appointment_model->insertAppointment($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->appointment_model->updateAppointment($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('home/myDetails');
        }
        
    }
	
	public function fromWebsite() {
		
		$id = $this->input->post('id');
		$patient = $this->input->post('name');
        $description = $this->input->post('note');
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $department = $this->input->post('dept');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('dept', 'Appointment', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('appointment');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'name' => $patient,
                'date' => $date,
                'description' => $description,
                'department' => $department,
                'time' => $time,
                'phone' => $phone,
                'email' => $email,
                'website' => 'website',
                
            );
			$this->session->set_flashdata('feedback', 'Appointment Made Succesfully, We will reach out to you Shortly');
            $this->appointment_model->insertAppointment($data);
			
			redirect('');
        }
        
    }
	
	public function patientRequest() {
		
		$id = $this->input->post('id');
		$patient = $this->input->post('patient');
        $description = $this->input->post('note');
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $department = $this->input->post('dept');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $doctor = $this->input->post('doctor');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('dept', 'Appointment', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('appointment');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'patient' => $patient,
                'date' => $date,
                'description' => $description,
                'department' => $department,
                'time' => $time,
                'phone' => $phone,
                'email' => $email,
                'doctor' => $doctor,
                'request' => 'request',
                
            );
			$this->session->set_flashdata('feedback', 'Appointment Made Succesfully, We will reach out to you Shortly');
            $this->appointment_model->insertAppointment($data);
			redirect('home');
        }
        
    }
	
	public function addNewByDoctor() {
		$id = $this->input->post('id');
		$patient = $this->input->post('patient');
		$doctor = $this->input->post('doctor');
        $description = $this->input->post('description');
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $department = $this->db->get_where('staff', array('id' => $doctor))->row()->dept;

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('dept', 'Appointment', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('appointment');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'patient' => $patient,
                'doctor' => $doctor,
                'date' => $date,
                'description' => $description,
                'department' => $department,
                'time' => $time,
                
            );
            if (empty($id)) {
                $this->appointment_model->insertAppointment($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->appointment_model->updateAppointment($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('appointment/myAppointment');
        }
        
    }
	
	public function addNewByPatient() {
		$id = $this->input->post('id');
		$patient = $this->input->post('patient');
		$doctor = $this->input->post('doctor');
        $description = $this->input->post('description');
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $department = $this->db->get_where('staff', array('id' => $doctor))->row()->dept;

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('dept', 'Appointment', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('appointment');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'patient' => $patient,
                'doctor' => $doctor,
                'date' => $date,
                'description' => $description,
                'department' => $department,
                'time' => $time,
				'request' => 'request',
                
            );
            if (empty($id)) {
                $this->appointment_model->insertAppointment($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->appointment_model->updateAppointment($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('appointment/mineAppointment');
        }
        
    }
	
	function getAppointmentByJason() {
		
		if ($this->ion_auth->in_group(array('admin'))) { 
			$query = $this->appointment_model->getAppointmentForCalendar();
		}
		
		if ($this->ion_auth->in_group(array('Staff'))) { 
			$staff_ion_id = $this->ion_auth->get_user_id();
			$check_doctor = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->profile;
			if ($check_doctor == 'Doctor') {
				$doctor_id = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->id;
				$query = $this->appointment_model->getAppointmentByDoctor($doctor_id);
			}else{
				$query = $this->appointment_model->getAppointmentForCalendar();
			}		
		}
		
		if ($this->ion_auth->in_group(array('Patient'))) { 
			$patient_ion_id = $this->ion_auth->get_user_id();
			$patient_id = $this->db->get_where('patient', array('ion_user_id' => $patient_ion_id))->row()->id;
			$query = $this->appointment_model->getAppointmentByPatient($patient_id);		
		}
		
		
       $settings = $this->settings_model->getSettings();
	   
        $jsonevents = array();

        foreach ($query as $entry) {
          
			if(empty($entry->status)) {
                $color = 'orange';
            }elseif ($entry->status) {
                $color = '#0080ff';
            }
			
			
            $doctor_name = $this->db->get_where('staff', array('id' => $entry->doctor))->row()->name;
            $patient_name = $this->db->get_where('patient', array('id' => $entry->patient))->row()->name;
			
            $info = '<br/>'. ' ' . $doctor_name . '<br/>' .' ' . $patient_name .  '<br/>' . ' ' . $entry->department . '<br/>' . ' Date: ' . $entry->date . ' ' . $entry->time;
          
            $jsonevents[] = array(
                'id' => $entry->id,
                'title' => $info,
                'start' => date('Y-m-d', strtotime($entry->date)),
                'color' => $color,
            );
        }

        echo json_encode($jsonevents);

        //  echo json_encode($data);
    }
	
	function editAppointmentByJason() {
        $id = $this->input->get('id');
        $data['appointment'] = $this->appointment_model->getAppointmentById($id);
        echo json_encode($data);
    }
	
	function goLive() {
        if (!$this->ion_auth->in_group(array('admin', 'Staff'))) {
            redirect('home/permission');
        }
        $appointment_id = $this->input->get('id');
        $appointment_details = $this->appointment_model->getAppointmentById($appointment_id);

        $patient = $appointment_details->patient;
        $patient_details = $this->patient_model->getPatientById($patient);
        $patient_name = $patient_details->name;
        $patient_ion_id = $patient_details->ion_user_id;

        if ($this->ion_auth->in_group(array('Staff'))) {
            $doctor_ion_id = $this->ion_auth->get_user_id();
            $doctor_details = $this->staff_model->getStaffByIonUserId($doctor_ion_id);
            $doctor = $doctor_details->id;
        } else {
            $doctor = $appointment_details->doctor;
            $doctor_details = $this->staff_model->getStaffById($doctor);
            $doctor_ion_id = $doctor_details->ion_user_id;
        }

        $doctorname = $doctor_details->name;

        if ($this->ion_auth->in_group(array('Staff'))) {
            if ($doctor != $appointment_details->doctor) {
                redirect('home/permission');
            }
        }

        $topic = 'Live Zoom Meeting';
        //$start_date = date('d-m-Y H:i A');
		$start_date = date('Y-m-d H:i');
	    $data = array(
            'patient' => $patient,
            'patientname' => $patient_name,
            'patient_ion_id' => $patient_ion_id,
            'doctor' => $doctor,
            'doctorname' => $doctorname,
            'doctor_ion_id' => $doctor_ion_id,
            'topic' => 'Live Zoom Meeting',
            'type' => 2,
            'start_time' => $start_date,
            'timezone' => 'UTC',
            'duration' => 60,
            'meeting_password' => '12345',
            'add_date' => date('m-d-y'),
            'registration_time' => time(),
            'user' => $this->ion_auth->get_user_id(),
        );

        $response = $this->createAMeeting($data, NULL);

        if (!empty($response->id)) {
            $data1 = array('meeting_id' => $response->id);
            $data2 = array_merge($data, $data1);
            $this->zoom_model->insertZoom($data2);
			$get_settings = $this->settings_model->getSettings();
			
			
			$smsSettings = $this->sms_model->getSmsSettings();
		    $sender = $smsSettings->sender;
	        $api_id = $smsSettings->api_id;
	        $username = $smsSettings->username;
		    $password = $smsSettings->password;
			$px_phone = $patient_details->phone;
			$message = 'A Live Zoom Appoinment Meeting has been started on ' . $get_settings->system_vendor . ' Login to join before it ends in 30 minutes' ;
		    $message1 = urlencode($message);
		    $send_now = file_get_contents('https://api.clickatell.com/http/sendmsg?user=' . $username . '&password=' . $password . '&api_id=' . $api_id . '&to=' . $px_phone . '&text=' . $message1);
            
			$live_id = $this->db->insert_id();
            redirect('zoom/zoomMeeting?zoom_meeting_soft=' . $live_id . '&zoom_meeting_token=' . $response->id);
        } else {
            $this->session->set_flashdata('feedback', 'error encountered going Live');
            redirect('appointment/myAppointment');
        }
    }
	
	//API Requests Starts
    public function getMeetingsByMeetingId($meeting_id) {
        $start_time = NULL;
        $data = array();
        $doctor_ion_id = $this->zoom_model->getMeetingByZoomMeetingId($meeting_id)->doctor_ion_id;
        $data['doctor_ion_id'] = $doctor_ion_id;
        $data['start_time'] = $start_time;
        $request_url = 'https://api.zoom.us/v2/meetings/' . $meeting_id;
        $response = $this->sendGetMeetingsRequest($data, $request_url);
        return $response;
    }

    public function createAMeeting($data = array(), $meeting_id) {
        $start_time = $data['start_time'];
        $createAMeetingArray = array();
        $createAMeetingArray['doctor_ion_id'] = $data['doctor_ion_id'];
        $createAMeetingArray['topic'] = $data['topic'];
        $createAMeetingArray['agenda'] = !empty($data['agenda']) ? $data['agenda'] : "";
        $createAMeetingArray['type'] = !empty($data['type']) ? $data['type'] : 2; //Scheduled
        $createAMeetingArray['start_time'] = $start_time;
        $createAMeetingArray['timezone'] = $data['timezone'];
        $createAMeetingArray['password'] = !empty($data['meeting_password']) ? $data['meeting_password'] : "";
        $createAMeetingArray['duration'] = !empty($data['duration']) ? $data['duration'] : 60;
        $createAMeetingArray['settings'] = array(
            'join_before_host' => !empty($data['join_before_host']) ? true : false,
            'host_video' => !empty($data['option_host_video']) ? true : true,
            'participant_video' => !empty($data['option_participants_video']) ? true : true,
            'auto_recording' => !empty($data['option_auto_recording']) ? $data['option_auto_recording'] : "none",
        );
        if (!empty($meeting_id)) {
            $request_url = 'https://api.zoom.us/v2/meetings/' . $meeting_id;
            return $this->sendUpdateRequest($createAMeetingArray, $request_url);
        } else {
            $request_url = 'https://api.zoom.us/v2/users/me/meetings';
            return $this->sendCreateRequest($createAMeetingArray, $request_url);
        }
    }

    public function deleteMeeting($meeting_id) {
        $start_time = NULL;
        $data = array();
        $doctor_ion_id = $this->zoom_model->getMeetingByZoomMeetingId($meeting_id)->doctor_ion_id;
        $data['doctor_ion_id'] = $doctor_ion_id;
        $data['start_time'] = $start_time;
        $request_url = 'https://api.zoom.us/v2/meetings/' . $meeting_id;
        return $this->sendDeleteRequest($data, $request_url);
    }

    protected function sendGetMeetingsRequest($data = array(), $request_url) {
        $jwt = $this->generateJWT($data);
        $headers = array(
            "authorization: Bearer" . $jwt,
            'content-type: application/json'
        );
        $postFields = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if (!$response) {
            return $err;
        }
        return json_decode($response);
    }

    protected function sendCreateRequest($data = array(), $request_url) {
        $jwt = $this->generateJWT($data);
        $headers = array(
            "authorization: Bearer" . $jwt,
            'content-type: application/json'
        );
        $postFields = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if (!$response) {
            return $err;
        }
        return json_decode($response);
    }

    protected function sendUpdateRequest($data = array(), $request_url) {
        $jwt = $this->generateJWT($data);
        $headers = array(
            "authorization: Bearer" . $jwt,
            'content-type: application/json'
        );
        $postFields = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if (!$response) {
            return $err;
        }
        return json_decode($response);
    }

    protected function sendDeleterequest($data = array(), $request_url) {
        $jwt = $this->generateJWT($data);
        $headers = array(
            "authorization: Bearer" . $jwt,
            'content-type: application/json'
        );
        $postFields = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if (!$response) {
            return $err;
        }
        return json_decode($response);
    }

    function generateJWT($data = array()) {
		$doktor_ion_id = $this->ion_auth->get_user_id();
	    $doktor_idd = $this->db->get_where('staff', array('ion_user_id' => $doktor_ion_id))->row()->id;

        $settings = $this->staff_model->getStaffById($doktor_idd);
        $api_key = $settings->api_key;
        $api_secret = $settings->api_secret;
        if (!empty($data['start_time'])) {
            $start_time = strtotime($data['start_time']);
        } else {
            $start_time = time();
        }
        $exp = $start_time + 3600;
        // Create token header as a JSON string
        $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
        // Create token payload as a JSON string
        $payload = json_encode(['iss' => $api_key, 'exp' => $exp]);
        // Encode Header to Base64Url String
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        // Encode Payload to Base64Url String
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $api_secret, true);
        // Encode Signature to Base64Url String
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        // Create JWT
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        return $jwt;
    }
	
	function confirmAppointment() {
        $id = $this->input->get('id');
        
		$data = array();
		$data = array(
			'status' => 'confirm',
		);
		
		$this->appointment_model->updateAppointment($id, $data);
		$this->session->set_flashdata('feedback', 'Approved');
        redirect('appointment/myAppointment');
    }
	
	
	function delete() {
        $id = $this->input->get('id');
        $this->appointment_model->delete($id);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('appointment');
    }


}

/* End of file appointment.php */
/* Location: ./application/modules/appointment/controllers/appointment.php */
