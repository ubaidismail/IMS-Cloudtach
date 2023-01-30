<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
if (isset($_SESSION['login'])) {
} else {
    echo 'somethig went wrong';
    redirect('LoginController');
}
include "inc/header.php";
$name = $this->session->get_userdata('name');
$checkin_id = $_SESSION['checkin_id'];
print_r($checkin_id);
$user_id = $name['user_id'];
$current_day = mdate('%d');
$cokkies_name = get_cookie('name');

$date = date('y-m-d', $t1);
$now = date('h:i:sa');
// print_r($data);
?>

<body class="sb-nav-fixed">
    <?php include "inc/nav.php"; ?>
    <div id="layoutSidenav">
        <?php include "inc/sidenav.php"; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Add Employee</h1>
                    <form action="" class='add_em_form'>
                        <label for=""><b>Role</b> <br>
                            <select name="e_role" id="e_role">
                                <option value="">Select Role</option>
                            </select><br>
                        </label> <br> 

                        <label for=""><b>Name</b> <br>
                            <input type="text" name="e_name">
                        </label>
                        <label for=""><b>Email</b> <br>
                            <input type="email" name="e_email">
                        </label>
                        <label for=""><b>Password</b> <br>
                            <input type="password" name="e_password">
                        </label>
                        <input type="submit" value="Save">
                    </form>

                </div>

            </main>
            <?php
            include "inc/footer.php";
            ?>