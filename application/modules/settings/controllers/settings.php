<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends MX_Controller {

    function __construct() {
       parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('patient/patient_model');
		$this->load->model('staff/staff_model');
		$this->load->model('sms/sms_model');
		$this->load->model('tpa/tpa_model');
		$this->load->model('bed/bed_model');
		$this->load->model('finance/finance_model');
		$this->load->model('appointment/appointment_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('settings_model');
        $this->load->model('ion_auth_model');

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
		
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('settings', $data);
        $this->load->view('home/footer'); // just the footer file
    } 


    public function update() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $title = $this->input->post('title');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $currency = $this->input->post('currency');
        $about_us = $this->input->post('about_us');
        $welcome_short = $this->input->post('welcome_short');
        $welcome_long = $this->input->post('welcome_long');
        $map_iframe = $this->input->post('map_iframe');
        $facebook = $this->input->post('facebook');
        $twitter = $this->input->post('twitter');
        $instagram = $this->input->post('instagram');
   
		$logo = $this->input->post('logo');
		$favicon = $this->input->post('favicon');
		$language = $this->input->post('language');
		$img_url = $this->input->post('img_url');
		$img_url_favicon = $this->input->post('img_url_favicon');
       

        if (!empty($email)) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            // Validating Name Field
            $this->form_validation->set_rules('name', 'System Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
            // Validating Password Field
            $this->form_validation->set_rules('title', 'Title', 'rtrim|equired|min_length[5]|max_length[100]|xss_clean');
            // Validating Email Field
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
            // Validating Address Field   
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[500]|xss_clean');
            // Validating Phone Field           
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[5]|max_length[50]|xss_clean');
            // Validating Department Field   
            $this->form_validation->set_rules('currency', 'Currency', 'trim|required|min_length[1]|max_length[3]|xss_clean');
            // Validating Department Field   
           
			
				
            if ($this->form_validation->run() == FALSE) {
                $data = array();
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('settings', $data);
                $this->load->view('home/footer'); // just the footer file
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
				
				$file_name1 = $_FILES['img_url_favicon']['name'];
                $file_name_pieces1 = explode('_', $file_name1);
                $new_file_name1 = '';
                $count11 = 1;
                foreach ($file_name_pieces1 as $piece1) {
                    if ($count1 !== 1) {
                        $piece1 = ucfirst($piece1);
                    }

                    $new_file_name1 .= $piece1;
                    $count1++;
                }
				
                $config = array(
                    'file_name' => $new_file_name1,
                    'upload_path' => "./uploads/",
                    'allowed_types' => "gif|jpg|png|jpeg|pdf",
                    'overwrite' => False,
                    'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    'max_height' => "1768",
                    'max_width' => "2024"
                );
				$this->load->library('Upload', $config);
				$this->upload->initialize($config);
		

                if ($this->upload->do_upload('img_url') && $this->upload->do_upload('img_url_favicon')) {
					
					if($this->upload->do_upload('img_url')){
                    $path = $this->upload->data();
                    $img_url = "uploads/" . $path['file_name'];
					}
					if($this->upload->do_upload('img_url_favicon')){
						$path1 = $this->upload->data();
						$img_url_favicon = "uploads/" . $path1['file_name'];
					}
					
					//$path1 = $this->upload->data();
                    $data = array();
                    $data = array(
					
							'system_vendor' => $name,
							'title' => $title,
							'address' => $address,
							'phone' => $phone,
							'email' => $email,
							'currency' => $currency,
							'favicon' => $img_url_favicon,
							'logo' => $img_url,
							'language' => $language,
							'about_us' => $about_us,
							'welcome_short' => $welcome_short,
							'instagram' => $instagram,
							'twitter' => $twitter,
							'facebook' => $facebook,
							'map_iframe' => $map_iframe,
							);
					
					} elseif ($this->upload->do_upload('img_url_favicon')) {
						$path1 = $this->upload->data();
						$img_url_favicon = "uploads/" . $path1['file_name'];
						$data = array();
						$data = array(
						
							'system_vendor' => $name,
							'title' => $title,
							'address' => $address,
							'phone' => $phone,
							'email' => $email,
							'currency' => $currency,
							'favicon' => $img_url_favicon,
							'language' => $language,
							'about_us' => $about_us,
							'welcome_short' => $welcome_short,
							'welcome_long' => $welcome_long,
							'instagram' => $instagram,
							'twitter' => $twitter,
							'facebook' => $facebook,
							'map_iframe' => $map_iframe,
							//'logo' => $img_url
							); 
							
					} elseif ($this->upload->do_upload('img_url')) {
                    $path = $this->upload->data();
                    $img_url = "uploads/" . $path['file_name'];
                    $data = array();
                    $data = array(
					
							'system_vendor' => $name,
							'title' => $title,
							'address' => $address,
							'phone' => $phone,
							'email' => $email,
							'currency' => $currency,
							'logo' => $img_url,
							'language' => $language,
							'about_us' => $about_us,
							'welcome_short' => $welcome_short,
							'welcome_long' => $welcome_long,
							'instagram' => $instagram,
							'twitter' => $twitter,
							'facebook' => $facebook,
							'map_iframe' => $map_iframe,
							);
							
					} else {
						$data = array();
						$data = array(
							'system_vendor' => $name,
							'title' => $title,
							'address' => $address,
							'phone' => $phone,
							'email' => $email,
							'currency' => $currency,
							'language' => $language,
							'about_us' => $about_us,
							'welcome_short' => $welcome_short,
							'welcome_long' => $welcome_long,
							'instagram' => $instagram,
							'facebook' => $facebook,
							'map_iframe' => $map_iframe,
							'twitter' => $twitter,
						);
					}
                $this->settings_model->updateSettings($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
                // Loading View
                redirect('settings');
            }
        } else {
            $this->session->set_flashdata('feedback', 'Email Required!');
            redirect('settings', 'refresh');
        }
    }
}

/* End of file settings.php */
/* Location: ./application/modules/settings/controllers/settings.php */