<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Finance_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPayment($data) {
		$this->db->order_by('id', 'desc');
        $this->db->insert('payment', $data);
    }

    function getPayment() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('payment');
        return $query->result();
    }

    function getPaymentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('payment');
        return $query->row();
    }

    function getPaymentByPatientIdByStatus($id) {
        $this->db->where('patient', $id);
        $this->db->where('status', 'unpaid');
        $query = $this->db->get('payment');
        return $query->result();
    }

    function getPaymentByPatientId($id) {
        $this->db->where('patient', $id);
        $query = $this->db->get('payment');
        return $query->result();
    }
	
	function getPaymentByStaffId($id) {
        $this->db->where('user', $id);
        $query = $this->db->get('payment');
        return $query->result();
    }

    function updatePayment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('payment', $data);
    }

    function insertPaymentCategory($data) {
		$this->db->order_by('id', 'desc');
        $this->db->insert('payment_category', $data);
    }

    function getPaymentCategory() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('payment_category');
        return $query->result();
    }

    function getPaymentCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('payment_category');
        return $query->row();
    }
    
	
	function getDoctorCommissionByCategory($data) {
        $this->db->where('category', $data);
        $query = $this->db->get('payment_category');
        return $query->row();
    }
	
    function updatePaymentCategory($id, $data) {
		$this->db->order_by('id', 'desc');
        $this->db->where('id', $id);
        $this->db->update('payment_category', $data);
    }

    function deletePayment($id) {
        $this->db->where('id', $id);
        $this->db->delete('payment');
    }

    function deletePaymentCategory($id) {
		$this->db->order_by('id', 'desc');
        $this->db->where('id', $id);
        $this->db->delete('payment_category');
    }

    function insertExpense($data) {
		$this->db->order_by('id', 'desc');
        $this->db->insert('expense', $data);
    }

    function getExpense() {
		$this->db->order_by('id', 'desc');
        $query = $this->db->get('expense');
        return $query->result();
    }

    function getExpenseById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('expense');
        return $query->row();
    }

    function updateExpense($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('expense', $data);
    }

    function insertExpenseCategory($data) {
        $this->db->insert('expense_category', $data);
    }

    function getExpenseCategory() {
        $query = $this->db->get('expense_category');
        return $query->result();
    }
	

    function getExpenseCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('expense_category');
        return $query->row();
    }

    function updateExpenseCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('expense_category', $data);
    }

    function deleteExpense($id) {
        $this->db->where('id', $id);
        $this->db->delete('expense');
    }

    function deleteExpenseCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('expense_category');
    }

    function getDiscountType() {
        $query = $this->db->get('settings');
        return $query->row()->discount;
    }

    function getPaymentByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getOtPaymentByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('ot_payment');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getExpenseByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('expense');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function lastPaidInvoice($id) {
        $this->db->where('patient', $id);
        $this->db->where('status', 'paid-last');
        $query = $this->db->get('payment');
        return $query->result();
    }

    function lastOtPaidInvoice($id) {
        $this->db->where('patient', $id);
        $this->db->where('status', 'paid-last');
        $query = $this->db->get('ot_payment');
        return $query->result();
    }

    function amountReceived($id, $data) {
        $this->db->where('id', $id);
        $query = $this->db->update('payment', $data);
    }
	
	function getThisMonth() {
        $payments = $this->db->get('payment')->result();
        foreach ($payments as $payment) {
            if (date('m/y', $payment->date) == date('m/y', time())) {
                $this_month_payment[] = $payment->gross_total;
            }
        }
        if (!empty($this_month_payment)) {
            $this_month_payment = array_sum($this_month_payment);
        } else {
            $this_month_payment = 0;
        }

        $expenses = $this->db->get('expense')->result();
        foreach ($expenses as $expense) {
            if (date('m/y', $expense->date) == date('m/y', time())) {
                $this_month_expense[] = $expense->amount;
            }
        }

        if (!empty($this_month_expense)) {
            $this_month_expense = array_sum($this_month_expense);
        } else {
            $this_month_expense = 0;
        }

        $this_month_details = array($this_month_payment, $this_month_expense);
        return $this_month_details;
    }

}
