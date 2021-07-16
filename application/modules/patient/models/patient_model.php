<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patient_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPatient($data) {
        $this->db->insert('patient', $data);
    }
	
	function insertMedicalHx($data) {
        $this->db->insert('medical_history', $data);
    }
	
	function insertDocument($data) {
        $this->db->insert('patient_document', $data);
    }
	
	function insertAdmission($data) {
        $this->db->insert('admit_px', $data);
    }

    function getPatient() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient');
        return $query->result();
    }
	
	function getDocument() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_document');
        return $query->result();
    }
	
	function getAdmission() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('admit_px');
        return $query->result();
    }
	
	function getMedicalHistory() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('medical_history');
        return $query->result();
    }

    function getPatientById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('patient');
        return $query->row();
    } 
	
	function getMedicalHxById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('medical_history');
        return $query->row();
    }

    function updateMedicalHx($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('medical_history', $data);
    }
	
	function updatePatient($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('patient', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('patient');
    }
	
	function deleteMedicalHistory($id) {
        $this->db->where('id', $id);
        $this->db->delete('medical_history');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }
	
	function insertSendWishes($data) {
        $this->db->insert('wishes', $data);
    }
    
    function getWishesByPatientThisYear($patient){
        $this->db->where('patient', $patient);
        $this->db->where('year', date('Y'));
        $query = $this->db->get('wishes');
        return $query->result();
    }

}
