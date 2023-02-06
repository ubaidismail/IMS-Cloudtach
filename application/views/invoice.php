<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

if (isset($_SESSION['login'])) {
    $name = $this->session->get_userdata('name');
    $checkin_id = $_SESSION['checkin_id'];
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
    <?php include "inc/sidenav.php";
    $invno = 'CT' . rand(0, 999);
    
   ?>
    
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="invoice-det">

                    <form id="invoice_form">
                        <div class="top-inv-pg">
                            <h1 class="mt-4">Invoice: <span><?php echo $invno; ?></span> </h1>
                            <button class="save_inv btn-primary">Save Invoice</button>
                            <div class="lds-dual-ring save_inv_ring"></div>
                        </div>
                        <div class="to-inv-det">

                            <div class="to-data">
                                <label for="">
                                    To: <input type="text" placeholder="Company Name" name="company_name">
                                </label>
                                <label for="">
                                    Address: <input type="text" placeholder="Anum blessings Shop# 22 Karachi Pakistan" name="address">
                                </label>
                                <label for="">
                                    Phone: <input type="text" placeholder="+92 333 43545" name="rece_phone">
                                </label>
                                <label for="">
                                    Incoice Type: <select name="invoice_type" id="invoice_type" placeholder='Select Option'>
                                        <option value="0">Select Option</option>
                                        <option value="simple">Simple</option>
                                        <option value="paid">Paid</option>
                                        <option value="pending">Pending</option>
                                        <option value="upfront">Upfront </option>
                                    </select>
                                </label>
                            </div>

                            <div class="data-dyn" id="data-dynamic-div">
                                <?php
                                if (!empty($data)) {
                                    foreach ($data as $d) {
                                        $img = $d->company_logo;
                                        if (!empty($img)) {
                                ?>
                                            <div class="fromimg">
                                                <img src="<?php echo base_url('uploads/' . $img); ?>" alt="">
                                                <a href="javascript:void(0)" class="remove-logo" data-img="<?php echo $img; ?>" data-user="<?php echo $user_id; ?>"><i class="fas fa-trash"></i></a>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="upload-btn-wrapper">
                                                <form enctype="multipart/form-data" id="company-logo-upload-form">
                                                    <input type="file" name="company_logo" id="company_logo" />
                                                    <i class="fas fa-upload" aria-hidden="true"></i>
                                                    <button class="btn">Upload Logo</button>
                                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
                                                <!-- </form> -->
                                            </div>
                                    <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <div class="upload-btn-wrapper">
                                        <form enctype="multipart/form-data" id="company-logo-upload-form">
                                            <input type="file" name="company_logo" id="company_logo" />
                                            <button class="btn">Upload Logo</button>
                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
                                        <!-- </form> -->
                                    </div>
                                <?php
                                }
                                ?>



                            </div>

                        </div>

                        <div class="row clearfix">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> # </th>
                                            <th class="text-center"> Project </th>
                                            <th class="text-center"> Qty </th>
                                            <th class="text-center"> Price </th>
                                            <th class="text-center"> Total </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id='addr0'>
                                            <td>1</td>
                                            <td><input type="text" name='project[]' placeholder='Enter Project Details' class="form-control" /></td>
                                            <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0" /></td>
                                            <td><input type="number" name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0" /></td>
                                            <td><input type="number" name='total[]' placeholder='0.00' class="form-control total" readonly /></td>
                                        </tr>
                                        <tr id='addr1'></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <span id="add_row" class="btn btn-default pull-left"><i class="fas fa-plus"></i></span>
                                <span id='delete_row' class="pull-right btn btn-default"><i class="fas fa-trash"></i></span>
                            </div>
                        </div>
                        <div class="row clearfix" style="margin-top:20px">
                            <div class="pull-right col-md-4">
                                <table class="table table-bordered table-hover" id="tab_logic_total">
                                    <tbody>
                                        <tr>
                                            <th class="text-center">Sub Total</th>
                                            <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly /></td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Shipping Cost</th>
                                            <td class="text-center">
                                                <div class="input-group mb-2 mb-sm-0">
                                                    <input type="number" class="form-control" name="shipping_cost" id="shipping_cost" placeholder="0">
                                                    <div class="input-group-addon"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">CGST Tax Amount</th>
                                            <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control"  /></td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Grand Total</th>
                                            <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly /></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="hidden" name="date_now" value="<?php echo Date('M d  Y -  h:m:s');?>" />
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
                    </form>
                </div>
            </div>
        </main>
        <?php
        include "inc/footer.php";
        ?>