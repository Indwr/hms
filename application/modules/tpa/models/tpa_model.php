<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tpa_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        
    }

    function getTpa() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('tpa');
       return $query->result();
    }


    function getTpaById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('tpa');
        return $query->row();
    }
	
	function updateTpa($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tpa', $data);
    }

    function insertTpa($data) {
        $this->db->insert('tpa', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('tpa');
    }
   

}
