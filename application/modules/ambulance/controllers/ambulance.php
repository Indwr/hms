<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ambulance extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('staff/staff_model');
        $this->load->model('patient/patient_model');
        $this->load->model('settings/settings_model');
		$this->load->model('sms/sms_model');
		$this->load->model('ambulance_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
		$data = array();
        $data['ambulances'] = $this->ambulance_model->getAmbulance();
        $data['ambulance_calls'] = $this->ambulance_model->getAmbulanceCall();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['patients'] = $this->patient_model->getPatient();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('ambulance', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function addNew() {
		$id = $this->input->post('id');
        $v_number = $this->input->post('v_number');
        $v_model = $this->input->post('v_model');
        $year_made = $this->input->post('year_made');
        $driver_n = $this->input->post('driver_n');
        $driver_c = $this->input->post('driver_c');
        $driver_l = $this->input->post('driver_l');
        $v_type = $this->input->post('v_type');
        $note = $this->input->post('note');
        

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('v_number', 'vehicle number', 'trim|xss_clean');
        $this->form_validation->set_rules('v_model', 'vehicle model', 'trim|xss_clean');
        $this->form_validation->set_rules('year_made', 'year made', 'trim|xss_clean');
        $this->form_validation->set_rules('driver_n', 'driver name', 'trim|xss_clean');
        $this->form_validation->set_rules('driver_c', 'driver contact', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('ambulance');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'v_number' => $v_number,
                'v_model' => $v_model,
                'year_made' => $year_made,
                'driver_n' => $driver_n,
                'driver_c' => $driver_c,
                'driver_l' => $driver_l,
                'v_type' => $v_type,
                'note' => $note,
                
            );
            if (empty($id)) {
                $this->ambulance_model->insertAmbulance($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->ambulance_model->updateAmbulance($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('ambulance');
        }
        
    }
	
	
	public function addNewAmbulanceCall() {
		$id = $this->input->post('id');
        $patient = $this->input->post('patient');
        $ambulance = $this->input->post('ambulance');
        $date = $this->input->post('date');
        $d_name = $this->input->post('d_name');
        $amount = $this->input->post('amount');
        

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('patient', 'patient', 'trim|xss_clean');
        $this->form_validation->set_rules('ambulance', 'ambulance', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('ambulance');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'patient' => $patient,
                'ambulance' => $ambulance,
                'date' => $date,
                'd_name' => $d_name,
                'amount' => $amount,
            );
            if (empty($id)) {
                $this->ambulance_model->insertAmbulanceCall($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->ambulance_model->updateAmbulanceCall($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('ambulance');
        }
        
    }
	
	function editAmbulanceByJason() {
        $id = $this->input->get('id');
        $data['ambulance'] = $this->ambulance_model->getAmbulanceById($id);
        echo json_encode($data);
    }
	
	function editAmbulanceCallByJason() {
        $id = $this->input->get('id');
        $data['ambulance_call'] = $this->ambulance_model->getAmbulanceCallById($id);
        echo json_encode($data);
    }
	
	
	function delete() {
        $id = $this->input->get('id');
        $this->ambulance_model->delete($id);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('ambulance');
    }
	
	function deleteAmbulanceCall() {
        $id = $this->input->get('id');
        $this->ambulance_model->deleteAmbulanceCall($id);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('ambulance');
    }


}

/* End of file ambulance.php */
/* Location: ./application/modules/ambulance/controllers/ambulance.php */
