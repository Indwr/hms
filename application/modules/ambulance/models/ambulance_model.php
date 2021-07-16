<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ambulance_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        
    }

    function getAmbulance() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('ambulance');
       return $query->result();
    }


    function getAmbulanceById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('ambulance');
        return $query->row();
    }
	
	function updateAmbulance($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('ambulance', $data);
    }

    function insertAmbulance($data) {
        $this->db->insert('ambulance', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('ambulance');
    }
	
	function getAmbulanceCall() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('ambulance_call');
       return $query->result();
    }


    function getAmbulanceCallById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('ambulance_call');
        return $query->row();
    }
	
	function updateAmbulanceCall($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('ambulance_call', $data);
    }

    function insertAmbulanceCall($data) {
        $this->db->insert('ambulance_call', $data);
    }

    function deleteAmbulanceCall($id) {
        $this->db->where('id', $id);
        $this->db->delete('ambulance_call');
    }
   

}
