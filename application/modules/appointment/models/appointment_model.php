<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Appointment_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        
    }

    function getAppointment() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('appointment');
       return $query->result();
    }


    function getAppointmentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('appointment');
        return $query->row();
    }
	
	function getAppointmentByDoctor($doctor_id) {
		$this->db->order_by('id', 'desc');
        $this->db->where('doctor', $doctor_id);
        $query = $this->db->get('appointment');
        return $query->result();
    }
	
	function getAppointmentByPatient($patient_id) {
		$this->db->order_by('id', 'desc');
        $this->db->where('patient', $patient_id);
        $query = $this->db->get('appointment');
        return $query->result();
    }
	
	function getAppointmentForCalendar() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('appointment');
        return $query->result();
    }
	

	function updateAppointment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('appointment', $data);
    }

    function insertAppointment($data) {
        $this->db->insert('appointment', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('appointment');
    }
   

}
