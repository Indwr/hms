<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        
    }

    function getReport() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('report');
       return $query->result();
    }


    function getReportById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('report');
        return $query->row();
    }
	
	function updateReport($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('report', $data);
    }

    function insertReport($data) {
        $this->db->insert('report', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('report');
    }
   

}
