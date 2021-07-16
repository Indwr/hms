<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class pharmacy_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        
    }

    function getpharmacy() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('payment_category');
       return $query->result();
    }
	
	function getMedicineCategory() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('medicine_category');
       return $query->result();
    }


    function getMedicineById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('payment_category');
        return $query->row();
    }
	
	function getMedicineCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('medicine_category');
        return $query->row();
    }
	
	function updatepharmacy($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('payment_category', $data);
    }
	
	function updateMedicineCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('medicine_category', $data);
    }

    function insertpharmacy($data) {
        $this->db->insert('payment_category', $data);
    }
	
	function insertMedicineCategory($data) {
        $this->db->insert('medicine_category', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('payment_category');
    }
	
	function deleteMedicineCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('medicine_category');
    }
   

}
