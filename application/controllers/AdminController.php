<?php

defined('BASEPATH') or exit('Your are not allowed to access this asset');
define('ABSPATH', __FILE__);
class AdminController extends CI_Controller
{

    function index()
    {
        $this->load->model('AdminModel');
        $data = $this->AdminModel->get_user_data();
        $this->load->view('dashboard', ['data' => $data]);

    }
    public function get_current_user_id()
    {
        echo 'ok';
    }

    function attendance()
    {
        $this->load->model('AdminModel');
        $data = $this->AdminModel->getData();
        $this->load->view('attendance', ['data' => $data]);

    }

    public function all_employes()
    {
        $this->load->model('AdminModel');
        $data = $this->AdminModel->get_user_data();
        $this->load->view('employee', ['data' => $data]);
    }
    function add_employes()
    {
        $this->load->view('add-employee');
    }

    function invoice()
    {
        $user_id = $_SESSION['user_id'];
        $this->load->model('AdminModel');
        $data = $this->AdminModel->get_img_for_inv_logo($user_id);
        if ($data) {
            $this->load->view('invoice', ['data' => $data]);
        } else {

            $this->load->view('invoice');
        }

    }
    function add_reminder()
    {
        $this->load->view('reminders');
    }

    function save_invoice()
    {
        $get_current_user_id = $this->input->post('user_id');
        $to = $this->input->post('company_name');
        $address = $this->input->post('address');
        $rece_phone = $this->input->post('rece_phone');
        $invoice_type = $this->input->post('invoice_type');
        $project = $this->input->post('project');
        $qty = $this->input->post('qty');
        $price = $this->input->post('price');
        $total = $this->input->post('total');
        $sub_total = $this->input->post('sub_total');
        $tax_amount = $this->input->post('tax_amount');
        $total_amount = $this->input->post('total_amount');
        $date_now = $this->input->post('date_now');

        $this->load->model('AdminModel');
        $data = $this->AdminModel->add_invoice_data($get_current_user_id, $to, $address, $rece_phone, $invoice_type, $project, $qty, $price, $total, $sub_total, $tax_amount, $total_amount, $date_now);
    }
    function past_invoices()
    {
        if (isset($_SESSION['login'])) {
            $user_id = $_SESSION['user_id'];
            if($user_id == false){
    
                redirect('https://dashboard.cloudtach.com/');
            
            }else{
    
                $this->load->model('AdminModel');
                $data = $this->AdminModel->get_invoice_data($user_id);
                $this->load->view('past_invoices', ['data' => $data]);
            }
        }else{
            redirect('LoginController');
            echo 'Session Expired';
        }
        // $user_id = $_SESSION['user_id'];
    }

    function delete_invoice()
    {
        $id = $_GET['id'];
        $this->load->model('AdminModel');
        $data = $this->AdminModel->delete_invoice($id);
        $this->session->set_flashdata('invoice_delete_sms', 'Invoice Deleted');
        $this->past_invoices();

    }
    function save_invoice_company_logo()
    {
        // $cat_image_name = $_FILES["company_logo"]["name"] ; 
        $image_path = realpath(APPPATH . '../uploads');
        $config['upload_path'] = $image_path;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '2048';
        $config['file_name'] = date("his");
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $file_name = $this->upload->do_upload('company_logo');

        if ($file_name) {
            $file_data = $this->upload->data();
            $userid = $this->input->post('user_id');
            $this->load->model('AdminModel');
            $image = $file_data['file_name'];
            $data = $this->AdminModel->add_custom_company_logo_to_inv($userid, $image);
            echo $data;
            if ($data) {
                echo 'ok';
            } else {
                echo 'Something went wrong';
            }
            //Do something with the file and extra data
        } else {
            $error = array('error' => $this->upload->display_errors());
            var_dump($error);
        }

    }
    function remove_invoice_company_logo()
    {
        $user_id = $this->input->post('user_id');
        $img = $this->input->post('img');
        $this->load->model('AdminModel');
        $data = $this->AdminModel->remove_logo_inv($user_id);
        $image_path = realpath(APPPATH . '../uploads/' . $img);
        if ($data) {
            unlink($image_path);
            echo '
            <div class="upload-btn-wrapper">
            <form enctype="multipart/form-data" id="company-logo-upload-form">
                <input type="file" name="company_logo" id="company_logo" />
                <i class="fas fa-upload" aria-hidden="true"></i>
                <button class="btn">Upload Logo</button>
                <input type="hidden" name="user_id" value="' . $user_id . '" />
            </form>
        </div>';
        } else {
            echo 'somethign went wrong';
        }
    }

    function convertpdf()
    {
        $this->load->library('pdf');
        $invoice_id = $_GET['invoice_id'];
        // $invoice_id = $this->input->post('invoice_id');
        $this->load->model('AdminModel');
        $data = $this->AdminModel->get_data_downloading_invoice($invoice_id);
        // $cont = $this->load->view('generate_pdf' , ['data' =>  $data]);
        foreach ($data as $d) {
            $invoice_type = $d->invoice_type;
            $company_logo = $d->company_logo;
            $path = base_url('uploads/'.$company_logo);// Modify this part (your_img.png
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            
            $html_content = '';
            $html_content .= '<div class="pdf-download" >
                <style>
                .inv.fromimg img {
                    width: 200px;
                    display: block;
                    margin: 0 auto;
                }

                table {
                    border: 1px solid #cccccc57;
                    background-color: white;
                }

                table thead,
                table td,
                table tr,
                table tfoot,
                table th {
                    border: 0 !important;
                }

                thead,
                tfoot {
                    background-color: #f8f9fa;
                    color: #000;
                }

                div#inner-pdf table thead,
                div#inner-pdf td,
                div#inner-pdf tr,
                div#inner-pdf tfoot,
                div#inner-pdf th,
                table#tab_logic_total {
                    border: 1px solid #dee2e6 !important;
                }

                .flex-inv-top {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .invoice-title h2 {
                    font-size: 22px;
                    font-family: "Work Sans", sans-serif;
                }

                address {
                    font-family: "Work Sans", sans-serif;
                }

                .panel.panel-default h3 strong {
                    font-weight: 400;
                    font-size: 23px;
                }

                .panel.panel-default {
                    font-family: "Work Sans", sans-serif;
                }

                .invoice-title {
                    border-bottom: 1px solid #ccc;
                    padding-bottom: 4px;
                    margin-bottom: 30px;
                }

                div#inner-pdf table thead {
                    background-color: #f8f9fa;
                    color: #000;
                    font-weight: 300;
                    font-family: "Work Sans";
                }

                th {
                    font-family: "Work Sans";
                    font-weight: 400 !important;
                }

                strong.inv_delte-sms {
                    position: absolute;
                    right: 30px;
                    top: 18px;
                }

                .inv_paid {
                    position: absolute;
                    right: 0;
                    background: #0964e4;
                    color: #fff;
                    padding: 10px 70px;
                    transform: rotateZ(35deg);
                    margin-top: 7px;
                }
                </style>
        <div id="inner-pdf">
        <div class="flex-inv-top">
        <div class="inv fromimg">
        <img src="'.$base64.'" alt="image">
        </div>
        </div>
            <div class="inv_type_marked">';

            if ($d->invoice_type == 'simple') {
                $html_content .= '';
            } else if ($d->invoice_type == 'paid') {
                $html_content .= '<div class="inv_paid">Paid</div>';
            } else if ($d->invoice_type == 'pending') {
                $html_content .= '<div class="inv_paid">Pending</div>';
            } else if ($d->invoice_type == 'upfront') {
                $html_content .= '<div class="inv_paid">Upfront</div>';
            }
            ;
            $html_content .= '<div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h2>Invoice for'
                . $d->company_name . '
                    </h2>
                    <div class="inv-id">Invoice ID:
                        ' . $d->id . '
                    </div>
                    <h3 class="pull-right"></h3>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-12">
    
                        <address>
                            <strong>Billed To:</strong><br>
                            Name: ' . $d->company_name . '</br>
                            Address: ' . $d->address . '<br>
                            Contact: ' . $d->client_phone . '<br>
                        </address>
                    </div>
    
                </div>
    
            </div>
        </div>';
            $html_content .= '<div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Invoice summary</strong>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table compact stripe" width="100%">
                                <thead>
                                    <tr>
                                        <td><strong>Product Type</strong></td>
                                        <td class="text-center">
                                            <strong>Price</strong>
                                        </td>
                                        <td class="text-center">
                                            <strong>Quantity</strong>
                                        </td>
                                        <td class="text-right">
                                            <strong>Totals</strong>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
    
                                    <tr>
                                        <td>
                                            ' . $d->project . '
                                        </td>
                                        <td class="text-center">
                                            ' . $d->qty . '
                                        </td>
                                        <td class="text-center">
                                            ' . $d->price . '
                                        </td>
                                        <td class="text-right">
                                            ' . $d->total . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-end">
                                            <strong>Subtotal</strong>
                                        </td>
                                        <td class="thick-line text-right">
                                            ' . $d->sub_total . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-end"><strong>Tax
                                                amount</strong></td>
                                        <td class="no-line text-right">
                                            ' . $d->tax_amount . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-end">
                                            <strong>Total Amount</strong>
                                        </td>
                                        <td class="no-line text-right">
                                            ' . $d->total_amount . '
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
            $html_content .= '</div>
        </div>
    </div>
</div>';


            // if(!empty($data)){
            $this->pdf->loadHtml($html_content);
            // $this->pdf->setPaper('A4', 'landscape');
            $this->pdf->render();
            $this->pdf->stream("invoice_d.pdf", array("Attachment" => 1)); // if 0 the file will open in another tab
        }
        // }
    }



}