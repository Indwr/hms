<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class pharmacy extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('staff/staff_model');
        $this->load->model('patient/patient_model');
        $this->load->model('settings/settings_model');
		$this->load->model('sms/sms_model');
		$this->load->model('finance/finance_model');
		$this->load->model('pharmacy_model');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
		 $data = array();
        $data['medicines'] = $this->pharmacy_model->getpharmacy();
        $data['staffs'] = $this->staff_model->getStaff();
		$data['MedicineCategorys'] = $this->pharmacy_model->getMedicineCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function MedicineCategory() {
		 $data = array();
        $data['MedicineCategorys'] = $this->pharmacy_model->getMedicineCategory();
        $data['staffs'] = $this->staff_model->getStaff();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine_category', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	public function addNewMedicineCategory() {
		$id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('pharmacy');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'name' => $name,
                'description' => $description
                
            );
            if (empty($id)) {
                $this->pharmacy_model->insertMedicineCategory($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->pharmacy_model->updateMedicineCategory($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('pharmacy/medicineCategory');
        }
        
    }
	
	function viewMedicine() {
        $data = array();
        $id = $this->input->get('id');
		$data['medicine'] = $this->pharmacy_model->getMedicineById($id);
		$data['medicineCategorys'] = $this->pharmacy_model->getMedicineCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('view_medicine', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	
	function viewMedicineCategory() {
        $data = array();
        $id = $this->input->get('id');
        $data['medicines'] = $this->pharmacy_model->getpharmacy();
		$data['medicineCategoryId'] = $id;
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('view_medicine_catg', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	
	public function addNew() {
		$id = $this->input->post('id');
        $dept = $this->input->post('dept');
        $description = $this->input->post('description');
        

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('dept', 'pharmacy', 'trim|xss_clean');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('pharmacy');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
                'dept' => $dept,
                'description' => $description
                
            );
            if (empty($id)) {
                $this->pharmacy_model->insertpharmacy($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->pharmacy_model->updatepharmacy($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('pharmacy');
        }
        
    }
	
	public function addMedicine() {
		
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');
        $c_price = $this->input->post('c_price');
        $cost_price = $this->input->post('cost_price');
        $howmany = $this->input->post('howmany');
        $catg = $this->input->post('catg');
        $str_box = $this->input->post('str_box');
        $e_date = $this->input->post('e_date');
        $unit = $this->input->post('unit');
        $staff_update = $this->input->post('staff_update');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('howmany', 'Quantity', 'trim|xss_clean');
       // Validating Description Field
        $this->form_validation->set_rules('cost_price', 'Cost Price', 'trim|xss_clean');
       // Validating Description Field
        $this->form_validation->set_rules('c_price', 'Category price', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('all_stock');
            $this->load->view('home/footer'); // just the header file
        } else {
			$settings = $this->settings_model->getSettings();
			$this->load->library('phpqrcode/qrlib');
			
			$SERVERFILEPATH = "./qr_code/";
		   
			$text = $category;
			$textName = $category;
			$textID = $id;
			$textP = $c_price;
			$textD = $e_date;
			$qr_text = "Stock: " . $textName . "  " . " Price: " . $settings->currency . number_format($textP); 
			$text1 = substr($text, 0,9);
			
			$folder = $SERVERFILEPATH;
			$file_name10 = $text1."-Qrcode" . rand(2, 200) . ".png";
			$file_name1 = $folder.$file_name10;
			QRcode::png($qr_text, $file_name1);
			
			
            $data = array();
            $data = array(
                'category' => $category,
                'description' => $description,
                'cost_price' => $cost_price,
                'howmany' => $howmany,
                'str_box' => $str_box,
                'catg' => $catg,
                'unit' => $unit,
                'e_date' => $e_date,
                'qr_code' => $file_name1,
                'staff_update' => $staff_update,
                'c_price' => $c_price
            );
            if (empty($id)) {
                $this->finance_model->insertPaymentCategory($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->finance_model->updatePaymentCategory($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('pharmacy');
        }
    }
	
	
	 public function addPayment() {
        $id = $this->input->post('id');
        $category_selected = array();
        // $amount_by_category = $this->input->post('category_amount');
        $category_selected = $this->input->post('category_name');
        
        $item_selected = $this->input->post('category_id');
        $quantity = $this->input->post('quantity');
       
        if (empty($item_selected)) {
            $this->session->set_flashdata('feedback', 'select a product');
            redirect('finance/addSales');
        } else {
            $item_quantity_array = array();
            $item_quantity_array = array_combine($item_selected, $quantity);
        }
        
        foreach ($item_quantity_array as $key => $value) {
                $current_item = $this->finance_model->getPaymentCategoryById($key);
                $category_price = $current_item->c_price;
				$cost = $current_item->cost_price;
                $category_type = $current_item->type;
				$current_stock = (string) $current_item->howmany;
                $qty = $value;
				
				if ($current_stock < $qty) {
                $this->session->set_flashdata('feedback', 'Insufficient Quantity' . " for " . $current_item->category);
                redirect('finance/addSales');
            }
                $cat_and_price[] = $key . '*' . $category_price . '*' . $category_type . '*' . $qty . '*' . $cost;
                $amount_by_category[] = $category_price * $qty;
               
            }
            
        $category_name = implode(',', $cat_and_price);

        $patient = $this->input->post('patient');
        $date = time();
        $discount = $this->input->post('discount');
        $amount_received = $this->input->post('amount_received');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Category Field
        // $this->form_validation->set_rules('category_amount[]', 'Category', 'min_length[1]|max_length[100]');
        // Validating Price Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Price Field
        $this->form_validation->set_rules('discount', 'Discount', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo '';
        } else {
            $amount = array_sum($amount_by_category);
            $sub_total = $amount;
            $discount_type = $this->finance_model->getDiscountType();
            if (!empty($doctor)) {
                $all_cat_name = explode(',', $category_name);
                foreach ($all_cat_name as $indiviual_cat_nam) {
                    $indiviual_cat_nam1 = explode('*', $indiviual_cat_nam);
                    $d_commission = $this->finance_model->getDoctorCommissionByCategory($indiviual_cat_nam1[0])->doc_com;
                    $h_commission = 100 - $d_commission;
                    $hospital_amount_by_category[] = $indiviual_cat_nam1[1] * $h_commission / 100;
                }
                 $hospital_amount = array_sum($hospital_amount_by_category);
                if ($discount_type == 'flat') {
                    $flat_discount = $discount;
                    $gross_total = $sub_total - $flat_discount;
                    $doctor_amount = $amount - $hospital_amount - $flat_discount;
                } else {
                    $flat_discount = $sub_total * ($discount / 100);
                    $gross_total = $sub_total - $flat_discount;
                    $doctor_amount = $amount - $hospital_amount - $flat_discount;
                }
            } else {
                $doctor_amount = '0';
                if ($discount_type == 'flat') {
                    $flat_discount = $discount;
                    $gross_total = $sub_total - $flat_discount;
					$hospital_amount = $gross_total;
                   
                } else {
                    $flat_discount = $amount * ($discount / 100);
                    $gross_total = $sub_total - $flat_discount;
                    $hospital_amount = $gross_total;
                }
            }
			
			$user_ion_id_1 = $this->ion_auth->get_user_id();
			$stafff = $this->db->get_where('staff', array('ion_user_id' => $user_ion_id_1))->row()->id;
            if ($this->ion_auth->in_group(array('Staff'))) {
				$paid_user = $stafff;
			} else{
				$paid_user = 'Administrator';
			}
			$payment_mode = $this->input->post('payment_mode');
        
                
            $data = array();
            if (empty($id)) {
                $data = array(
                    'category_name' => $category_name,
                    'patient' => $patient,
                    'date' => $date,
                    'amount' => $sub_total,
                    'discount' => $discount,
                    'flat_discount' => $flat_discount,
                    'gross_total' => $gross_total,
                    'amount_received' => $amount_received,
                    'payment_mode' => $payment_mode,
                    'user' => $paid_user,
                    'status' => 'unpaid',
                    
                );
                $this->finance_model->insertPayment($data);
                
                $inserted_id = $this->db->insert_id();
                
                foreach ($item_quantity_array as $key => $value) {
                    $previous_qty = $this->db->get_where('payment_category', array('id' => $key))->row()->howmany;
                    $new_qty = $previous_qty - $value;
                    $this->db->where('id', $key);
                    $this->db->update('payment_category', array('howmany' => $new_qty));
                }
                
                $this->session->set_flashdata('feedback', 'Payment Completed');
                redirect("finance/invoice?id=" . "$inserted_id");
            } else {
                $data = array(
                    'category_name' => $category_name,
                    'patient' => $patient,
                    'amount' => $sub_total,
                    'discount' => $discount,
                    'flat_discount' => $flat_discount,
                    'gross_total' => $gross_total,
                    'amount_received' => $amount_received
                   
                );
                $this->finance_model->updatePayment($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
                redirect("finance/invoice?id=" . "$id");
            }
        }
    }
	
	function load() {
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
		$staff_update = $this->input->post('staff_update');
        $previous_qty = $this->db->get_where('payment_category', array('id' => $id))->row()->howmany;
        $new_qty = $previous_qty + $qty;
        $new_qty_staff = $staff_update . ' ' . 'with' . ' ' .$qty;
        $data = array();
        $data = array(
			'howmany' => $new_qty,
			'staff_update' => $new_qty_staff
		);
        $this->finance_model->updatePaymentCategory($id, $data);
        $this->session->set_flashdata('feedback', 'Loaded');
        redirect('pharmacy');
    }
	
	
	function editMedicineByJason() {
        $id = $this->input->get('id');
        $data['medicine'] = $this->pharmacy_model->getMedicineById($id);
        echo json_encode($data);
    }
	
	function editMedicineCategoryByJason() {
        $id = $this->input->get('id');
        $data['MedicineCategory'] = $this->pharmacy_model->getMedicineCategoryById($id);
        echo json_encode($data);
    }
	
	
	function deleteMedicineCategory() {
        $id = $this->input->get('id');
        $this->pharmacy_model->deleteMedicineCategory($id);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('pharmacy/MedicineCategory');
    }
	
	public function addMedicineSales() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->finance_model->getPaymentCategory();
        $data['patients'] = $this->patient_model->getPatient();
         
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_sales_medicine', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
	function deleteMedicine() {
        $id = $this->input->get('id');
		$data = array();
		$data = array(
			'deletii' => 'deletii',
		);
        $this->finance_model->updatePaymentCategory($id, $data);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('pharmacy');
    }


}

/* End of file pharmacy.php */
/* Location: ./application/modules/pharmacy/controllers/pharmacy.php */
