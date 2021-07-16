<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notice_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        
    }

    function getNotice() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('notice');
       return $query->result();
    }


    function getNoticeById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('notice');
        return $query->row();
    }
	
	function updateNotice($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('notice', $data);
    }

    function insertNotice($data) {
        $this->db->insert('notice', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('notice');
    }
   

}
