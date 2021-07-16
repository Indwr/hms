<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Zoom_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        
    }
	
	function updateZoom($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('staff', $data);
    }
	

    function insertZoom($data) {
        $this->db->insert('meeting', $data);
    }
	
	function getZoomMeeting() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('meeting');
        return $query->result();
    }
	function getZoomMeetingById($data) {
		$this->db->where('id', $id);
        $query = $this->db->get('meeting');
        return $query->row();
    }
	
	function getMeetingByZoomMeetingId($id) {
        $this->db->where('meeting_id', $id);
        $query = $this->db->get('meeting');
        return $query->row();
    }



}
