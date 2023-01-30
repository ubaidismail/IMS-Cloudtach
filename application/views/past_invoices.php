<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
if (isset($_SESSION['login'])) {
} else {
    echo 'Session Expired';
    redirect('LoginController');
}
include "inc/header.php";
$name = $this->session->get_userdata('name');
$user_id = $name['user_id'];
$current_day = mdate('%d');
$cokkies_name = get_cookie('name');
?>
<?php include "inc/nav.php"; ?>


<div id="layoutSidenav">
    <?php include "inc/sidenav.php";
    ?>
    <div id="layoutSidenav_content">
        <div class="contetn-area">
            <main>
                <strong class="btn btn-success inv_delte-sms">
                    <?php echo $this->session->flashdata('invoice_delete_sms'); ?>
                </strong>
                <h1 class="mt-4">All Invoices</h1>

                <div class="container-fluid px-4">
                    <div class="pst-invoices">
                        <table id="invoice_lists" class="display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Company Name</th>
                                    <th>Email / Phone</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    <th>Invoice Type</th>
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
                                    $invoice_user_id = $d->user_id;
                                    $company_name = $d->company_name;
                                    $address = $d->address;
                                    $client_phone = $d->client_phone;
                                    $project = $d->project;
                                    $qty = $d->qty;
                                    $price = $d->price;
                                    $total = $d->total;
                                    $sub_total = $d->sub_total;
                                    $tax_amount = $d->tax_amount;
                                    $total_amount = $d->total_amount;
                                    $invoice_type = $d->invoice_type;
                                    $date = $d->date;
                                    $company_logo = $d->company_logo;
                                    if ($invoice_user_id == $user_id) {

                                        ?>
                                        <tr>

                                            <td>
                                                <?php echo $number; ?>
                                            </td>
                                            <td>
                                                <?php echo (!empty($company_name) ? $company_name : '') ?>
                                            </td>
                                            <td>
                                                <?php echo (!empty($client_phone) ? $client_phone : '') ?>
                                            </td>
                                            <td>
                                                <?php echo (($address) ? $address : '-') ?>
                                            </td>
                                            <td>
                                                <?php echo (($date) ? $date : '-') ?>
                                            </td>
                                            <td>
                                                <?php echo (($invoice_type) ? $invoice_type : '-') ?>
                                            </td>
                                            <td>
                                                <a href="/index.php/AdminController/convertpdf?invoice_id=<?php echo $id;?>" data-invID="<?php echo $id; ?>" id="view_inv_<?php echo $id; ?>"class="btn btn-primary view_inv_btn">Download Invoice</a>
                                                
                                                <a href="<?php echo site_url('AdminController/delete_invoice?id=' . $id) ?>"
                                                    id="delete_inv" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>

                                    <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S.no</th>
                                    <th>Company Name</th>
                                    <th>Email / Phone</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    <th>Invoice Type</th>
                                    <th>View PDF</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </main>
        </div>



        <?php
        include "inc/footer.php";
        ?>