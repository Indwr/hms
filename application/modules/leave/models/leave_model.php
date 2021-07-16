<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Leave_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        
    }

    function getLeave() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('leave_application');
       return $query->result();
    }


    function getLeaveById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('leave_application');
        return $query->row();
    }
	
	function updateLeave($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('leave_application', $data);
    }

    function insertLeave($data) {
        $this->db->insert('leave_application', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('leave_application');
    }
   

}
