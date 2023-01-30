<?php
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

?>
<?php include "inc/nav.php"; ?>
<div id="layoutSidenav">
    <?php include "inc/sidenav.php";
    ?>
    <div id="layoutSidenav_content">
        <main>
        <strong class="btn btn-success inv_delte-sms"><?php echo $this->session->flashdata('fee_delete_sms'); ?></strong>
            <h1 class="mt-4">Student Fee</h1>
            <div class="container-fluid px-4">
                <div class="pst-invoices">
                    <table id="invoice_lists" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Student Name</th>
                                <th>Email / Phone</th>
                                <th>Address</th>
                                <th>View PDF</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $number = 0;
                            foreach ($data as $d) {
                                $number++;
                                // $ret_date = (!empty($data['checkin_day'])? $data['checkin_day'] : '');
                                $id = $d->id;
                                $student_name = $d->student_name;
                                $address = $d->address;
                                $phone = $d->phone;
                                $fee_of_month = $d->fee_of_month;
                                $month_count = $d->month_count;
                                $fee = $d->fee;
                                $total = $d->total;
                            ?>

                                <tr>

                                    <td><?php echo $number; ?></td>
                                    <td><?php echo (!empty($student_name) ? $student_name : '') ?></td>
                                    <td><?php echo (!empty($phone) ? $phone : '') ?></td>
                                    <td><?php echo (($address) ? $address : '-') ?></td>
                                    <td><a href="javascript:void(0)" id="view_inv_<?php echo $id; ?>" class="btn btn-primary view_inv_btn" onclick="view_invoice(this.id)">View Invoice</a>
                                        <a href="<?php echo site_url('AcademyController/delete_acd_invoice?id='.$id) ?>" id="delete_inv" class="btn btn-danger">Delete</a>
                                        <!-- for pdf -->
                                        <div class="pdf-download" id="view_inv_<?php echo $id; ?>" hidden>
                                            <div id="inner-pdf">
                                                <div class="flex-inv-top">
                                                    <a href="javascript:window.print()"><i class="fa fa-print" aria-hidden="true"></i></a>
                                                    <div class="inv fromimg">
                                                        <img src="<?php echo base_url('/admin-assets/img/login-logo.png'); ?>" alt="">
                                                    </div>
                                                    <button type="button" class="close" aria-label="Close" id="view_inv_<?php echo $id; ?>" onclick="close_invoice(this.id)">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="invoice-title">
                                                            <h2>Fee: <?php echo $student_name; ?></h2>
                                                            <div class="inv-id">Fee ID: <?php echo 'CT'. $id; ?></div>
                                                            <h3 class="pull-right"></h3>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-12">

                                                                <address>
                                                                    <strong>Billed To:</strong><br>
                                                                    <?php echo 'Name: ' . $student_name; ?><br>
                                                                    <?php echo 'Address: ' . $address; ?><br>
                                                                    <?php echo 'Contact: ' . $phone; ?><br>
                                                                </address>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h3 class="panel-title"><strong>Fee summary</strong></h3>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-condensed">
                                                                        <thead>
                                                                            <tr>
                                                                                <td><strong>Fee Of Month</strong></td>
                                                                                <td class="text-center"><strong>Fee</strong></td>
                                                                                <td class="text-center"><strong>No Of Months</strong></td>
                                                                                <td class="text-right"><strong>Totals</strong></td>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <!-- foreach ($order->lineItems as $line) or some such thing here -->

                                                                            <tr>
                                                                                <td><?php echo $fee_of_month; ?></td>
                                                                                <td class="text-center"><?php echo $month_count; ?></td>
                                                                                <td class="text-center"><?php echo $fee; ?></td>
                                                                                <td class="text-right"><?php echo $total; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="no-line"></td>
                                                                                <td class="no-line"></td>
                                                                                <td class="no-line text-end"><strong>Total Amount</strong></td>
                                                                                <td class="no-line text-right"><?php echo $total; ?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- for pdf -->
                                    </td>
                                </tr>

                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S.no</th>
                                <th>Company Name</th>
                                <th>Email / Phone</th>
                                <th>Address</th>
                                <th>View PDF</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </main>
        <?php
        include "inc/footer.php";
        ?>