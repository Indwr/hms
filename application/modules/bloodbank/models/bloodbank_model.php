<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bloodbank_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        
    }

    function getBloodbank() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('bloodbank');
       return $query->result();
    }


    function getBloodbankById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('bloodbank');
        return $query->row();
    }
	
	function updateBloodbank($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('bloodbank', $data);
    }

    function insertBloodbank($data) {
        $this->db->insert('bloodbank', $data);
    }
	
	function getDonor() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('donor');
       return $query->result();
    }

    function getDonorById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('donor');
        return $query->row();
    }
	
	function updateDonor($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('donor', $data);
    }

    function insertDonor($data) {
        $this->db->insert('donor', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('donor');
    }
   

}
