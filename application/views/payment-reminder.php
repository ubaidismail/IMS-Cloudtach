<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
if (isset($_SESSION['login'])) {
    $name = $this->session->get_userdata('name');
    $user_id = $name['user_id'];
    $current_day = mdate('%d');
    $cokkies_name = get_cookie('name');
} else {
    echo 'Session Expired';
    redirect('Login');
}
include "inc/header.php";
?>
<?php include "inc/nav.php"; ?>


<div id="layoutSidenav">
    <?php include "inc/sidenav.php";
    ?>
    <div id="layoutSidenav_content">
        <div class="contetn-area payment-reminder">
            <main>
                <h1 class="mt-1">Payment Reminder</h1>

                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"><i>
                            <?php echo Date('F  d  Y'); ?>
                        </i></li>
                </ol>
                <section>
                    <div class="add-emp add-rem">
                        <!-- add contact for payment remidner -->
                        <a href="javascript:void(0)" id="add_contact">Add Contact <i class="fa fa-plus"
                                aria-hidden="true"></i></a>
                        <div class="add-contact-form" hidden>
                            <form action="" >
                                <div class="mb-3">
                                    <div class="clost-contact-add-form">
                                        <a href="javascript:void(0)">&times;</a>
                                    </div>
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" name="contact-name" id="contact-name"
                                        placeholder="name@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="contact-email" id="contact-email"
                                        placeholder="John">
                                </div>
                                <div class="mb-3">
                                    <label for="number" class="form-label">Phone:</label>
                                    <input type="number" class="form-control" name="contact-phone" id="contact-phone"
                                        placeholder="+1 333 33333">
                                </div>
                                <input type="submit" class="btn btn-primary" name="contact-submit" id="contact-submit">
                            </form>
                        </div>
                    </div>
                </section>
            </main>
        </div>



        <?php
        include "inc/footer.php";
        ?>