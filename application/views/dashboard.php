<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (isset($_SESSION['login'])) {

} else {
    // echo 'somethig went wrong';
    redirect('Login/login_view');
}


include "inc/header.php";
?>

    <?php include "inc/nav.php"; ?>
    <div id="layoutSidenav">
        <?php include "inc/sidenav.php"; ?>
        <div id="layoutSidenav_content">
            <main>
                <?php
                    if(isset($_SESSION['email_status'])){

                        ?>
                            <div class="email-verify bg-light">
                                <i class="fas fa-exclamation-triangle text-danger"></i> <span class="text-danger">|</span> 
                                    <strong class="text-danger">Please Verify Your email! <a href="#">Send Verfification Link</a></strong>
                            </div>
                        <?php
                    }
                ?>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><i><?php echo Date('F  d  Y');?></i></li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <h4><strong></strong></h4>
                                    Stocks
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <h4></h4>
                                    Total Sale
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="https://trello.com/b/kJMjV7KF/web-dev-projects" target="_blank">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <h4></h4>
                                    Invoices
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="https://trello.com/b/kJMjV7KF/web-dev-projects" target="_blank">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">

                                <div class="card-body">
                                    <h4></h4>
                                    Orders Failed
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="https://trello.com/b/kJMjV7KF/web-dev-projects" target="_blank">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Area Chart Example
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Bar Chart Example
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
            <?php
            include "inc/footer.php";
            ?>
            <script>
                if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
            </script>