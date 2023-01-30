<?php


defined('BASEPATH') OR exit('Your are not allowed to access this asset');

class Activate extends CI_Controller{
    function index(){
        if(isset($_GET['token'])){
            $data = 'ok'; 
            $user_id = $_GET['user'];
            $this->load->model('LoginModel');
            $update_email_status = $this->LoginModel->update_email_status($user_id);
            $this->load->view('activate-account.php' , ['data' => $data]);
        }
    }
}
