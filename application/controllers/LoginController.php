<?php

defined('BASEPATH') or exit('Your are not allowed to access this asset');

class LoginController extends CI_Controller
{
    function index()
    {
        $this->load->view('dashboard');
    }
    function login_view(){
        
        $this->load->view('join');
    }
    function login_func()
    {
        if (isset($_SESSION['login'])) {
                $this->index();
        }else{

            $name = $this->input->post('name');
            $pass = md5($this->input->post('password'));
            if (!empty($name || $pass)) {
                $this->load->model('LoginModel');
                $get_register_user = $this->LoginModel->get_user_login_details($name, $pass);
                $get_user_role = $this->LoginModel->get_user_roles($name, $pass);
                if ($get_register_user) {
                    $_SESSION['login'] = 'login';
                    $user_id = '';
                    foreach ($get_register_user as $user) {
                        $user_id = $user->user_id;
                        $name = $user->name;
                        $email_status = $user->email_status;
                    }
                    foreach ($get_user_role as $data) {
                        $role = $data->user_role;
                    }
    
                    $this->session->set_userdata('user_id', $user_id);
                    $this->session->set_userdata('user_name', $name);
                    $this->session->set_userdata('user_role', $role);
                    if($email_status == 0){
                        
                        $this->session->set_userdata('email_status', $email_status);
                    }
                    // exit;
                    $this->load->view('dashboard', ['name' => $name]);
                    $cookie = array(
                        'name'   => 'name',
                        'value'  => $name,
                        'expire' => '36000',
                    );
                    set_cookie($cookie);
                   
                } else {
                    echo 'Please enter correct username or password';
                }
            }
        }
    }

    function register_func()
    {
        $email_address = $this->input->post('email_address');
        $pass = md5($this->input->post('password'));

        $explode = explode("@", $email_address);
         array_pop($explode);
        $name = join('@', $explode);

        if (!empty($email_address || $pass)) {
            $this->load->model('LoginModel');
            $get_register_user = $this->LoginModel->add_data_to_databse($email_address, $name , $pass);
            if ($get_register_user) {
                $token = bin2hex(openssl_random_pseudo_bytes(32));
                $message = "Hi there! Your Account has been created here is the activation link https://dashboard.cloudtach.com/index.php/Activate?token=$token&user=" . $get_register_user;

                mail($email_address, 'Activate Account', $message);
                // header("Location:index.php?success=" . urlencode("Activation Email Sent!"));
            } else {
                echo 'Please enter correct username or password';
            }
        }
    }
    function logout_cp()
    {
        $logout = session_destroy();
        if ($logout) {
            redirect('LoginController');
        } else {
            echo 'something went wrong';
        }
    }
}
