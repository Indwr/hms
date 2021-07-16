<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bed_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertBed($data) {
        $this->db->insert('bed', $data);
    }
	
	function insertAllotedBed($data) {
        $this->db->insert('allot_bed', $data);
    }
	
	function insertBedType($data) {
        $this->db->insert('bed_type', $data);
    }
	
	function getBed() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('bed');
        return $query->result();
    }
	
	function getBedType() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('bed_type');
        return $query->result();
    }
	
	function getAllotedBed() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('allot_bed');
        return $query->result();
    }

    function getBedById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('bed');
        return $query->row();
    }
	
	function getBedAllotmentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('allot_bed');
        return $query->row();
    }
	
	function getAllotedBedById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('allot_bed');
        return $query->row();
    }
	
	function getBedTypeById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('bed_type');
        return $query->row();
    }
	
	function getAllotedBedByIdB($id, $patient) {
		$this->db->where('bed', $id);
		$this->db->where('patient', $patient);
        $query = $this->db->get('allot_bed');
        return $query->row();
    }
	
	function updateBed($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('bed', $data);
	}
    
	
	function updateBedType($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('bed_type', $data);
    }
	
	function updateAllotedBed($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('allot_bed', $data);
    }
	
	function getAllotedBedByPatient($patient, $bed){
        $this->db->where('patient', $patient);
        $this->db->where('bed', $bed);
        $query = $this->db->get('allot_bed');
        return $query->result();
    }

    function deleteBed($id) {
        $this->db->where('id', $id);
        $this->db->delete('bed');
    }
	
	function deleteBedType($id) {
        $this->db->where('id', $id);
        $this->db->delete('bed_type');
    }
	
	function deleteBedAllotment($id) {
        $this->db->where('id', $id);
        $this->db->delete('allot_bed');
    }

}
