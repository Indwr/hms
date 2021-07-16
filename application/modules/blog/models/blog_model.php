<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertBlog($data) {
        $this->db->insert('blog', $data);
    }
	
	function insertItem($data) {
        $this->db->insert('item', $data);
    }
	
	function insertBlogSettings($data) {
        $this->db->insert('item', $data);
    }
	
	function getBlogSettings (){
		$query = $this->db->get('blog_settings');
        return $query->row();
	}
	
	function updateBlogSettings($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('blog_settings', $data);
    }

    function getItem() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('blog');
        return $query->result();
    }
	
	function insertQuantity($data) {
        $this->db->insert('quantity', $data);
    }

    function getQuantity() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('quantity');
        return $query->result();
    }
	
	public function get_count() 
	{
		$this->db->order_by('id', 'desc');
        return $this->db->count_all("blog");
    }

    public function get_posts($limit, $start) 
	{
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get("blog");
        return $query->result();
    }
	
	function getBlog() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('blog');
        return $query->result();
    }

    function getBlogById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('blog');
        return $query->row();
    }
	
	function getItemById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('blog');
        return $query->row();
    }

    function updateItem($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('item', $data);
    }
	
	function getQuantityById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('quantity');
        return $query->row();
    }

    function updateQuantity($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('quantity', $data);
    }
	
	function updateBlog($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('blog', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('blog');
    }

}
