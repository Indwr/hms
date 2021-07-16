<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Finance extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('finance_model');
        $this->load->model('patient/patient_model');
        $this->load->model('settings/settings_model');
		$this->load->model('staff/staff_model');
        $data['settings'] = $this->settings_model->getSettings();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
        redirect('home');
    }

    public function allpayments() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
		$patient_check = $this->settings_model->getSettings();
		if($patient_check->patient_sales == 'off') {
			redirect('home');
		}
        $data['settings'] = $this->settings_model->getSettings();
        $data['payments'] = $this->finance_model->getPayment();
        $data['staffs'] = $this->staff_model->getStaff();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('payment', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addpayments() {
		
        $data = array();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->finance_model->getPaymentCategory();
        $data['patients'] = $this->patient_model->getPatient();
        $data['staffs'] = $this->staff_model->getStaff();
         
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_addpayment', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPayment() {
        $id = $this->input->post('id');
        $category_selected = array();
        // $amount_by_category = $this->input->post('category_amount');
        $category_selected = $this->input->post('category_name');
        
        $item_selected = $this->input->post('category_id');
        $quantity = $this->input->post('quantity');
        $doctor = $this->input->post('doctor');
       $cat_and_price = array();
	   
        if (empty($item_selected)) {
            $this->session->set_flashdata('feedback', 'select a procedure');
            redirect('finance/addpayments');
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
				
                $cat_and_price[] = $key . '*' . $category_price . '*' . $category_type . '*' . $qty . '*' . $cost . '*' . $current_item->category;
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
            $discount_type = 'flat';
            if (!empty($doctor)) {
                $all_cat_name = explode(',', $category_name);
                foreach ($all_cat_name as $indiviual_cat_nam) {
                    $indiviual_cat_nam1 = explode('*', $indiviual_cat_nam);
                    $d_commission = $this->finance_model->getDoctorCommissionByCategory($indiviual_cat_nam1[5])->doc_com;
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
                    'hospital_amount' => $hospital_amount,
                    'doc_com' => $doctor_amount,
                    'doctor' => $doctor,
                    'status' => 'unpaid',
                    
                );
                $this->finance_model->insertPayment($data);
                
                $inserted_id = $this->db->insert_id();
                
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

    function editPayment() {
        if ($this->ion_auth->in_group(array('admin'))) {
            $data = array();
            $data['discount_type'] = $this->finance_model->getDiscountType();
            $data['settings'] = $this->settings_model->getSettings();
            $data['categories'] = $this->finance_model->getPaymentCategory();
            $data['patients'] = $this->patient_model->getPatient();
            $id = $this->input->get('id');
            $data['payment'] = $this->finance_model->getPaymentById($id);
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_sales', $data);
			$data['staffs'] = $this->staff_model->getStaff();
            $this->load->view('home/footer'); // just the footer file
        }
    }
    
    function addPaymentByPatient() {
		
        $data = array();
        $id = $this->input->get('id');
		$data['staffs'] = $this->staff_model->getStaff();
        $data['patient'] = $this->patient_model->getPatientById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('choose_payment_type', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function addSalePosByPatientToken() {
		
		$patient_check = $this->settings_model->getSettings();
		if($patient_check->patient_sales == 'off') {
			redirect('home');
		}
		
        $id = $this->input->get('id');
        $payment_token = $this->input->get('payment_token');
        $data = array();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->finance_model->getPaymentCategory();
         

        $data['patient'] = $this->patient_model->getPatientById($id);
        if ($payment_token == '5e05efe9acd1a52238db3e51471b5f923a3481975f65d') {
			$data['staffs'] = $this->staff_model->getStaff();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_sales_single', $data);
            $this->load->view('home/footer'); // just the footer fi
        } 
    }

    public function paymentProcedures() {
		$this->db->order_by('id', 'desc');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['categories'] = $this->finance_model->getPaymentCategory();
		$data['staffs'] = $this->staff_model->getStaff();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('all_paymentProcedures', $data);
        $this->load->view('home/footer'); // just the header file
    }
	

    public function addpaymentProcedures() {
		
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');
        $c_price = $this->input->post('c_price');
        $type = $this->input->post('type');
        $doc_com = $this->input->post('doc_com');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('all_paymentProcedures');
            $this->load->view('home/footer'); // just the header file
        } else {
			$settings = $this->settings_model->getSettings();
			
            $data = array();
            $data = array(
                'category' => $category,
                'description' => $description,
                'c_price' => $c_price,
                'doc_com' => $doc_com,
                'type' => $type,
            );
            if (empty($id)) {
                $this->finance_model->insertPaymentCategory($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->finance_model->updatePaymentCategory($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('finance/paymentProcedures');
        }
    }

	function viewpaymentProceduresStock() {
        $data = array();
        $id = $this->input->get('id');
        $data['category'] = $this->finance_model->getPaymentCategoryById($id);
		$data['warehouses'] = $this->warehouse_model->getWarehouse();
        $data['product_categorys'] = $this->category_model->getCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('view_stock', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	
	function getStockByAjax() {
        $id = $this->input->get('id');
        $data['category'] = $this->finance_model->getPaymentCategoryById($id);
        echo json_encode($data);
    }
	
	function editPaymentProceduresByJason() {
        $id = $this->input->get('id');
        $data['paymentProcedures'] = $this->finance_model->getPaymentCategoryById($id);
        echo json_encode($data);
    }

    function deletePaymentProcedures() {
        $id = $this->input->get('id');
		$data = array();
		$data = array(
			'deletii' => $deletii,
		);
        $this->finance_model->updatePaymentCategory($id, $data);
		$this->session->set_flashdata('feedback', 'Deleted');
        redirect('finance/paymentProcedures');
    }

    public function expense() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['expenses'] = $this->finance_model->getExpense();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('expense', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseView() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->finance_model->getExpenseCategory();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpense() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $date = time();
        $amount = $this->input->post('amount');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        // Validating Category Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Generic Name Field
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Company Name Field
        $data['settings'] = $this->settings_model->getSettings();
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['categories'] = $this->finance_model->getExpenseCategory();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_expense_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            if (empty($id)) {
                $data = array(
                    'category' => $category,
                    'date' => $date,
                    'amount' => $amount,
                    'description' => $description
                );
            } else {
                $data = array(
                    'category' => $category,
                    'description' => $description,
                    'amount' => $amount
                );
            }
            if (empty($id)) {
                $this->finance_model->insertExpense($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->finance_model->updateExpense($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('finance/expense');
        }
    }

    function editExpense() {
        $data = array();
        $data['categories'] = $this->finance_model->getExpenseCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $id = $this->input->get('id');
        $data['expense'] = $this->finance_model->getExpenseById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function deleteExpense() {
        $id = $this->input->get('id');
        $this->finance_model->deleteExpense($id);
        redirect('finance/expense');
    }

    public function expenseCategory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->finance_model->getExpenseCategory();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('expense_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseCategoryView() {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_category');
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseCategory() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Description Field
        $data['settings'] = $this->settings_model->getSettings();
        $this->form_validation->set_rules('description', 'Description', 'trim|required|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_expense_category');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array('category' => $category,
                'description' => $description
            );
            if (empty($id)) {
                $this->finance_model->insertExpenseCategory($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->finance_model->updateExpenseCategory($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('finance/expenseCategory');
        }
    }
	

    function editExpenseCategory() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['category'] = $this->finance_model->getExpenseCategoryById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_category', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function deleteExpenseCategory() {
        $id = $this->input->get('id');
        $this->finance_model->deleteExpenseCategory($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('finance/expenseCategory');
    }

    function invoice() {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payment'] = $this->finance_model->getPaymentById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('invoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function amountReceived() {
        $id = $this->input->post('id');
        $amount_received = $this->input->post('amount_received');
        $previous_amount_received = $this->db->get_where('payment', array('id' => $id))->row()->amount_received;
        $amount_received = $amount_received + $previous_amount_received;
        $data = array();
        $data = array('amount_received' => $amount_received);
        $this->finance_model->amountReceived($id, $data);
        redirect('finance/invoice?id=' . $id);
    }

    function amountReceivedFromCT() {
        $id = $this->input->post('id');
        $amount_received = $this->input->post('amount_received');
        $payments = $this->finance_model->getPaymentByPatientId($id);
        foreach ($payments as $payment) {
            if ($payment->gross_total != $payment->amount_received) {
                $due_balance = $payment->gross_total - $payment->amount_received;
                if ($amount_received <= $due_balance) {
                    $data = array();
                    $new_amount_received = $amount_received + $payment->amount_received;
                    $data = array('amount_received' => $new_amount_received);
                    $this->finance_model->amountReceived($payment->id, $data);
                    break;
                } else {
                    $data = array();
                    $new_amount_received = $due_balance + $payment->amount_received;
                    $data = array('amount_received' => $new_amount_received);
                    $this->finance_model->amountReceived($payment->id, $data);
                    $amount_received = $amount_received - $due_balance;
                }
            }
        }
        redirect('finance/patientPaymentHistory?id=' . $id . '&history_token=5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1');
    }

    function patientPaymentHistory() {
		$patient_check = $this->settings_model->getSettings();
		if($patient_check->patient_sales == 'off') {
			redirect('home');
		}
        $id = $this->input->get('id');
        $history_token = $this->input->get('history_token');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payments'] = $this->finance_model->getPaymentByPatientId($id);
        $data['patient_id'] = $id;
		if($history_token = '5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1'){
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('invoiceCT', $data);
        $this->load->view('home/footer'); // just the footer fi
		}
    }
	
	function staffFinanceTransactionHistory() {
		$patient_check = $this->settings_model->getSettings();
		if($patient_check->patient_sales == 'off') {
			redirect('home');
		}
        $id = $this->input->get('id');
        $staffFinanceTransactionHistory = $this->input->get('staffFinanceTransactionHistory');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payments'] = $this->finance_model->getPaymentByStaffId($id);
        $data['staff_id'] = $id;
		if($history_token = '5e0611fbea43e9f74ae56b5c09dc7de09bf4bc0d808a1'){
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('finance_history_staff', $data);
        $this->load->view('home/footer'); // just the footer fi
		}
    }


    function Report() {
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 24 * 60 * 60;
        }
        $data = array();
        $data['payment_categories'] = $this->finance_model->getPaymentCategory();
        $data['expense_categories'] = $this->finance_model->getExpenseCategory();

        $data['payments'] = $this->finance_model->getPaymentByDate($date_from, $date_to);
        $data['expenses'] = $this->finance_model->getExpenseByDate($date_from, $date_to);
        // } 
        $data['from'] = $this->input->post('date_from');
        $data['to'] = $this->input->post('date_to');
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('financial_report', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

}

/* End of file finance.php */
/* Location: ./application/modules/finance/controllers/finance.php */