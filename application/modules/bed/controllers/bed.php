<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bed extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('bed_model');
        $this->load->model('finance/finance_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('settings/settings_model');
		$this->load->model('staff/staff_model');
		$this->load->model('tpa/tpa_model');
		$this->load->model('patient/patient_model');
		$this->load->model('patient/patient_model');
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
		
        $data['items'] = $this->finance_model->getPaymentCategory();
        $data['beds'] = $this->bed_model->getBed();
        $data['patients'] = $this->patient_model->getPatient();
        $data['bed_types'] = $this->bed_model->getBedType();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['tpas'] = $this->tpa_model->getTpa();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('bed', $data);
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
				'hospital_amount' => $bed_price_payment,
				'status' => 'unpaid',
				'bed_qty' => $no_of_days . ' days',
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
			$this->session->set_flashdata('feedback', 'Bed Alloted and Patient Admitted');	
            redirect('bed/bedStatus');
        }
        
    } 
	
	
	public function admitBed() {
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
				'hospital_amount' => $bed_price_payment,
				'status' => 'unpaid',
				'bed_qty' => $no_of_days . ' days',
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
			$this->session->set_flashdata('feedback', 'Bed Alloted and Patient Admitted');	
            redirect('bed');
        }
        
    } 
	
	public function admitAllotBed() {
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
				'hospital_amount' => $bed_price_payment,
				'status' => 'unpaid',
				'bed_qty' => $no_of_days . ' days',
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
			$this->session->set_flashdata('feedback', 'Bed Alloted and Patient Admitted');	
            redirect('bed/bedAllotment');
        }
        
    } 

	
	public function bedStatus() {
		
        $data['items'] = $this->finance_model->getPaymentCategory();
        $data['beds'] = $this->bed_model->getBed();
        $data['patients'] = $this->patient_model->getPatient();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['tpas'] = $this->tpa_model->getTpa();
        $data['bed_types'] = $this->bed_model->getBedType();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('bed_status', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function bedTypes() {
		
        $data['items'] = $this->finance_model->getPaymentCategory();
        $data['beds'] = $this->bed_model->getBed();
        $data['bed_types'] = $this->bed_model->getBedType();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('bed_types', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function bedAllotment() {
		
        $data['items'] = $this->finance_model->getPaymentCategory();
        $data['beds'] = $this->bed_model->getBed();
        $data['patients'] = $this->patient_model->getPatient();
        $data['alloted_beds'] = $this->bed_model->getAllotedBed();
		
        $data['staffs'] = $this->staff_model->getStaff();
        $data['tpas'] = $this->tpa_model->getTpa();
        $data['bed_types'] = $this->bed_model->getBedType();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('allot_bed', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
   

    public function addNewBed() {
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$bed_type = $this->input->post('bed_type');
		$fee = $this->input->post('fee');
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('bed_type', 'bed_type', 'trim|xss_clean');
        $this->form_validation->set_rules('fee', 'fee', 'trim|xss_clean');
      
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('bed');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'name' => $name,
                'type' => $bed_type,
                'fee' => $fee
            );
            if (empty($id)) {
            $this->bed_model->insertBed($data);
			$this->session->set_flashdata('feedback', 'Added');	
            } else {
                $this->bed_model->updateBed($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('bed');
        }
        
    } 
	
	
	public function addNewBedAllotment() {
		$id = $this->input->post('id');
		$patient = $this->input->post('patient');
		$bed = $this->input->post('bed');
		$dd_date = $this->input->post('dd_date');
		$a_date = $this->input->post('a_date');
        
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
            $this->load->view('bed');
            $this->load->view('home/footer'); // just the header file
        } else {
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
            if (empty($id)) {
            $this->bed_model->insertAllotedBed($data);
			$this->session->set_flashdata('feedback', 'Added');	
            } else {
                $this->bed_model->updateAllotedBed($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('bed/bedAllotment');
        }
        
    } 
	
	public function addNewBedType() {
		$id = $this->input->post('id');
		$name = $this->input->post('name');
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        // Validating Description Field
      
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('bed');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'name' => $name,
            );
            if (empty($id)) {
            $this->bed_model->insertBedType($data);
			$this->session->set_flashdata('feedback', 'Added');	
            } else {
                $this->bed_model->updateBedType($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('bed/bedTypes');
        }
        
    }
	
	

    function getBed() {
        $data['bed'] = $this->bed_model->get_bed();
        $this->load->view('bed', $data);
    }
	
    function editBed() {
        $data = array();
        $id = $this->input->get('id');
        $data['bed'] = $this->bed_model->getBedById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	
	function deleteBed() {
        $id = $this->input->get('id');
        $this->bed_model->deleteBed($id);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('bed');
    }
	
	function deleteBedAllotment() {
        $id = $this->input->get('id');
        $this->bed_model->deleteBedAllotment($id);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('bed/bedAllotment');
    }
	
	function deleteBedType() {
        $id = $this->input->get('id');
        $this->bed_model->deleteBedType($id);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('bed/bedTypes');
    }

    function editBedByJason() {
        $id = $this->input->get('id');
        $data['bed'] = $this->bed_model->getBedById($id);
        echo json_encode($data);
    }
	
	function editBedAllotmentByJason() {
        $id = $this->input->get('id');
        $data['bedAllotment'] = $this->bed_model->getBedAllotmentById($id);
        echo json_encode($data);
    }
	
	function editBedTypeByJason() {
        $id = $this->input->get('id');
        $data['bed_type'] = $this->bed_model->getBedTypeById($id);
        echo json_encode($data);
    }
	
	
	function editBedSentByJasonB() {
        $id = $this->input->get('id');
		
		$supplier_ion_id = $this->ion_auth->get_user_id();
		$supplier = $this->db->get_where('supplier', array('ion_user_id' => $supplier_ion_id))->row()->id;

        $data['quote'] = $this->bed_model->getBedSentByIdB($id, $supplier);
        echo json_encode($data);
    }
	

    function quoteByBed() {
        $id = $this->input->get('id');
        $data['bed_id'] = $id;
        $data['quote'] = $this->bed_model->getQuote();
        $data['quote'] = $this->bed_model->getQuoteById($id);
        $data['quotes'] = $this->bed_model->getQuote();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('quote_by_bed', $data);
        $this->load->view('home/footer'); // just the header file
    }

}

/* End of file bed.php */
    /* Location: ./application/modules/bed/controllers/bed.php */
    