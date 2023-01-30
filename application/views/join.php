<?php
defined('BASEPATH') or exit('No direct script access allowed');
// if (isset($_SESSION['login'])) {
//   redirect('LoginController/login_func');
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />

  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="robots" content="noindex">
  <meta name="googlebot" content="noindex">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Login - Dashboard</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/admin-styles.css'); ?>">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<style>
  body#login-pg {
    overflow-y: hidden;
  }

  .join-tabs img {
    width: 34%;
    margin: 0 auto;
    display: block;
  }

  .login-form h3 {
    text-align: center;
    margin: 10px 0;
    color: #31375a !important;
    font-weight: 700;
  }
</style>

<body id="login-pg">

  <div class="container-fluid">
    <div class="row">
      <!-- <div class="col-6 lf-logs">
        <div class="div-lf">
          <img src="<?php //echo base_url('admin-assets/img/login-img.png'); 
                    ?>" alt="">
        </div>
      </div> -->
      <!-- col-2 -->
      <div class="col-12">
        <div class="login-area">
          
          <div class="join-tabs">
          <img src="<?php echo base_url('admin-assets/img/login-logo.png'); ?>" alt="" />
            <div class="tabset">
              <!-- Tab 1 -->
              <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
              <label for="tab1" class="tabs_logs">Login</label>
              <!-- Tab 2 -->
              <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
              <label for="tab2" class="tabs_logs">Signup</label>
              <!-- Tab 3 -->


              <div class="tab-panels">
                <section id="marzen" class="tab-panel">
                  <div class="login-form">
                    <?php echo form_open('LoginController/login_func'); ?>

                    <div class="form-group">
                      <label for="exampleInputEmail1" class="text-dark">Name</label>
                      <input type="name" class="form-control" name="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1" class="text-dark">Password</label>
                      <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit-login">Login</button>

                    </form>
                  </div>
                </section>
                <section id="rauchbier" class="tab-panel">
                  <div class="register-form" id="register_form">
                    <?php echo form_open('LoginController/register_func'); ?>

                    <div class="form-group">
                      <label for="exampleInputEmail1" class="text-dark">Email</label>
                      <input type="email" class="form-control" name="email_address" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1" class="text-dark">Password</label>
                      <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit-login">SignUp</button>
                    </form>

                  </div>
                </section>

              </div>

            </div>

          </div>
        </div>
      </div>
    </div>

  </div>


</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $('.register-form form').submit(function(e) {
    e.preventDefault();
    $('.register-form form button').attr('disabled', true);
    // alert('ok');
    $.ajax({
      url: '/index.php/LoginController/register_func',
      type: 'POST',
      data: $('.register-form form').serialize(),
      success: function(response) {
        $('.register-form form button').attr('disabled', false);
        $('<span class="succes-sms-register text-success">Success! Please Activate your account from email. Thanks</span>').insertAfter('.register-form form');

      }
    });
  });
</script>

</html>