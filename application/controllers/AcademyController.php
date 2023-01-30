<?php
defined('BASEPATH') or exit('Your are not allowed to access this asset');

class AcademyController extends CI_Controller
{
    function index()
    {
        $this->load->model('AdminModel');
        $data = $this->AdminModel->get_user_data();
        $this->load->view('dashboard', ['data' => $data]);
        
    }
    function studentFee()
    {
        // $this->load->view('dashboard' , ['data' => $data]);
        $this->load->view('student-fee');
    }

    function save_fee()
    {
        $st_name = $this->input->post('student_name');
        $address = $this->input->post('student_address');
        $st_phone = $this->input->post('student_phone');
        $date = $this->input->post('fee_of_month');
        $no_of_mont = $this->input->post('number_of_month');
        $fee = $this->input->post('fee');
        $total_fee = $this->input->post('total_fee');

        $this->load->model('AdminModel');
        $data = $this->AdminModel->add_fee_data($st_name, $address, $st_phone, $date, $no_of_mont, $fee, $total_fee);
    }
    function all_fee()
    {
        $this->load->model('AdminModel');
        $data = $this->AdminModel->get_fee_data();
        $this->load->view('fee',  ['data' => $data]);
    }
    function delete_acd_invoice()
    {
        $id = $_GET['id'];
        $this->load->model('AdminModel');
        $data = $this->AdminModel->delete_acd_fee($id);
        $this->session->set_flashdata('fee_delete_sms', 'Fee Voucher Deleted');
        $this->all_fee();
    }
}
