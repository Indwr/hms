<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('blog_model');
        $this->load->model('finance/finance_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('settings/settings_model');
		$this->load->model('staff/staff_model');
        $this->load->model('ion_auth_model');
		
        $this->load->helper('url','form');
        $this->load->library("pagination");
    }

    public function index() {
		
		if ($this->ion_auth->in_group(array('Staff'))) {
			$staff_ion_id = $this->ion_auth->get_user_id();
			$staff = $this->db->get_where('staff', array('ion_user_id' => $staff_ion_id))->row()->id;
			$permissions = $this->staff_model->getStaffById($staff)->permission;
			$permission1 = explode(',', $permissions);
			if (!in_array('blog', $permission1)) {
			 redirect('home/permission', 'refresh');	
			}
		} 	
		if (!$this->ion_auth->in_group(array('Staff', 'Doctor', 'admin'))) {
			redirect('site', 'refresh');
		}
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
		
        $data['blogs'] = $this->blog_model->getBlog();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('blog', $data);
        $this->load->view('home/footer'); // just the header file
    } 

	public function blogPosts() {
		
		
		$data = array();
		$config = array();
		
        $config["base_url"] = "blog/blogPosts";
        $config["total_rows"] = $this->blog_model->get_count();
        $config["per_page"] = $this->db->get('blog_settings')->row()->page;
        $config["uri_segment"] = 3;
		$config["full_tag_open"] = '<p>';
		

        $this->pagination->initialize($config);

		
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		
        $data["links"] = $this->pagination->create_links();

        $data['blogs'] = $this->blog_model->get_posts($config["per_page"], $page);
		
        
        $data['settings'] = $this->settings_model->getSettings();
		$data['blogss'] = $this->blog_model->getBlog();
        $this->load->view('site/site_head', $data); // just the header file
        $this->load->view('blogPost', $data);
        $this->load->view('site/site_footer', $data); // just the header file
		
    }
	
	public function blogSearch() {
		
		$search = $this->input->post('search');
		
		$data = array();
		$config = array();
		
        $config["base_url"] = "blog/blogSearch";
        $config["total_rows"] = $this->blog_model->get_count();
        $config["per_page"] = $this->db->get('blog_settings')->row()->page;
        $config["uri_segment"] = 3;
		$config["full_tag_open"] = '<p>';
		

        $this->pagination->initialize($config);

		
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		
        $data["links"] = $this->pagination->create_links();
        $data["search"] = $search;

        $data['blogs'] = $this->blog_model->get_posts($config["per_page"], $page);
		
        
        $data['settings'] = $this->settings_model->getSettings();
		$data['blogss'] = $this->blog_model->getBlog();
        $this->load->view('site/site_head', $data); // just the header file
        $this->load->view('blogPostSearch', $data);
        $this->load->view('site/site_footer', $data); // just the header file
		
    }

    public function addNewView() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	
    public function addNew() {
		$id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
       // $img_url = $this->input->post('img_url');
        

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
      
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('blog');
            $this->load->view('home/footer'); // just the header file
        } else {
			
			$file_name = $_FILES['img_url']['name'];
			$file_name_pieces = explode('_', $file_name);
			$new_file_name = '';
			$count = 1;
			foreach ($file_name_pieces as $piece) {
				if ($count !== 1) {
					$piece = ucfirst($piece);
				}

				$new_file_name .= $piece;
				$count++;
			}
			
			$config = array(
				'file_name' => $new_file_name,
				'upload_path' => "./uploads/",
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => False,
				'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "1768",
				'max_width' => "2024"
			);
			$this->load->library('Upload', $config);
			$this->upload->initialize($config);
			
			if($this->upload->do_upload('img_url')){
			$path = $this->upload->data();
			$img_url = "uploads/" . $path['file_name'];

				$data = array();
				$data = array(
					'name' => $name,
					'description' => $description,
					'user' => $this->ion_auth->user()->row()->username,
					'post_date' => time(),
					'img' => $img_url
					
				);
			} else{
				$data = array();
				$data = array(
					'name' => $name,
					'description' => $description,
					'user' => $this->ion_auth->user()->row()->username,
					'post_date' => time(),
					//'img' => $img_url
					
				);
			}
            if (empty($id)) {
                $this->blog_model->insertBlog($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->blog_model->updateBlog($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('blog');
        }
        
    }
	
	public function setting_update() {
		$id = $this->input->post('id');
        $page = $this->input->post('page');
        $related = $this->input->post('related');
        

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
      
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('blog');
            $this->load->view('home/footer'); // just the header file
        } else {
			
			$file_name = $_FILES['img_url']['name'];
			$file_name_pieces = explode('_', $file_name);
			$new_file_name = '';
			$count = 1;
			foreach ($file_name_pieces as $piece) {
				if ($count !== 1) {
					$piece = ucfirst($piece);
				}

				$new_file_name .= $piece;
				$count++;
			}
			
			$config = array(
				'file_name' => $new_file_name,
				'upload_path' => "./uploads/",
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => False,
				'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "1768",
				'max_width' => "2024"
			);
			$this->load->library('Upload', $config);
			$this->upload->initialize($config);
			
			if($this->upload->do_upload('img_url')){
			$path = $this->upload->data();
			$img_url = "uploads/" . $path['file_name'];
			}
			
            $data = array();
            $data = array(
                'page' => $page,
                'related' => $related,
                'logo' => $img_url
                
            );
			$this->blog_model->updateBlogSettings($id, $data);
			$this->session->set_flashdata('feedback', 'Updated');
		
            redirect('blog/settings');
        }
        
    }

    function getBlog() {
        $data['blog'] = $this->blog_model->get_blog();
        $this->load->view('blog', $data);
    }
	
	function settings() {
        $data = array();
        $data['settings'] = $this->blog_model->getBlogSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('setting', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	
	

    function editBlogPost() {
        $data = array();
        $id = $this->input->get('id');
        $data['blog'] = $this->blog_model->getBlogById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('blog_edit', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editBlogByJason() {
        $id = $this->input->get('id');
        $data['blog'] = $this->blog_model->getBlogById($id);
        echo json_encode($data);
    }
	
	function viewBlogPost() {
        $data = array();
        $id = $this->input->get('id');
		
        $data['blogs'] = $this->blog_model->getBlog();
        $data['blog'] = $this->blog_model->getItemById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('site/site_head', $data); // just the header file
        $this->load->view('blog_single', $data);
        $this->load->view('site/site_footer'); // just the footer file
    }
	
	function editItemByJason() {
        $id = $this->input->get('id');
        $data['item'] = $this->blog_model->getItemById($id);
        echo json_encode($data);
    }
	
	function getProductBlogByAjax() {
        $id = $this->input->get('id');
        $blog_id = $this->db->get_where('payment_category', array('id' => $id))->row()->str_box;
        $data['emanating_blog'] = $this->db->get_where('blog', array('id' => $blog_id))->row()->name;
        echo json_encode($data);
    }
	
	function deleteblogItem() {
        $id = $this->input->get('id');
        $this->blog_model->delete($id);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('blog');
    }
	
	
	
	

}

/* End of file blog.php */
    /* Location: ./application/modules/blog/controllers/blog.php */
    