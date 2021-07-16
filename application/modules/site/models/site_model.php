<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getSum($field, $table) {
        $this->db->select_sum($field);
        $query = $this->db->get($table);
        return $query->result();
    }

}
