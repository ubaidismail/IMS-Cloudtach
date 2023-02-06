<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
if (isset($_SESSION['login'])) {
    $name = $this->session->get_userdata('name');
    $checkin_id = $_SESSION['checkin_id'];
    print_r($checkin_id);
    $user_id = $name['user_id'];
    $current_day = mdate('%d');
    $cokkies_name = get_cookie('name');
} else {
    echo 'somethig went wrong';
    redirect('Login');
}
include "inc/header.php";
?>

<?php include "inc/nav.php"; ?>
<div id="layoutSidenav">
    <?php include "inc/sidenav.php"; ?>
    <div id="layoutSidenav_content">
            <div class="reminder-main">
            <div class="container-fluid px-4">
            <h1 class="mt-4">Add Reminder</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><i><?php echo Date('F  d  Y'); ?></i></li>
            </ol>
            <div class="notes-here mt-3">
                <div class="row">
                    <div class="col-6">
                        <div id="reminder_form">
                            <div class="form-group">
                                <textarea placeholder="Add your tasks here" class="form-control" id="reminder_txt_input" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success mt-2" id="save-click">Save</button>
                        </div>
                    </div>
                    <div class="col-6">
                        
                        <div class="land_txt_here">
                            <ul></ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
            </div>
        <!-- </div> -->
        <?php
        include "inc/footer.php";
        ?>