<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                <a class="nav-link" href="index">
                    <span>Dashboard</span>
                    <div class="sb-nav-link-icon" hidden><img src="<?php echo base_url('admin-assets/img/dashboard.png'); ?>" alt=""></div>
                </a>

                <?php
                if ($_SESSION['user_role'] === 'admin') {
                ?>
                    <li class="nav-item dropdown" id="access_db_tab">
                        <a href="https://phpmyadmin.wp-arena.com/index.php" target="_blank" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span>Access Database</span>
                            <div class="sb-nav-link-icon" hidden><i class="fas fa-database"></i></div>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id='view-db-pass' href='javascript:void(0)'>View DB Credentials</a>
                        </div>
                    </li>
                <?php }
                ?>
                <a class="nav-link" href="<?php echo site_url("Admin/add_reminder"); ?>">
                    <span>Add Tasks</span>
                    <div class="sb-nav-link-icon" hidden><img src="<?php echo base_url('admin-assets/img/bell.png'); ?>" alt=""></div>
                </a>
                <a class="nav-link" href="<?php echo site_url("Admin/payment_reminder"); ?>">
                    <span>Payment Remidner</span>
                    <div class="sb-nav-link-icon" hidden>
                        <img src="<?php echo base_url('admin-assets/img/payday.png'); ?>" alt="">
                    </div>
                </a>
                <!-- <li class="nav-item"> -->
                <a class="nav-link" data-bs-toggle="collapse" href="#collapse_nav_users" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                    Manage Invoice
                    <i class='fas fa-angle-down'></i>
                    <div class="sb-nav-link-icon" hidden><img src="<?php echo base_url('admin-assets/img/invoice-ico.png'); ?>" alt=""></div>
                </a>
                <div id="collapse_nav_users" class="collapse multi-collapse nav_users" style="">
                    <a href="<?php echo site_url("Admin/invoice"); ?>">
                        Generate Invoice
                    </a>
                    <a href="<?php echo site_url("Admin/past_invoices"); ?>">
                        View Invoice
                    </a>
                </div>
                <a class="nav-link" href="<?php echo site_url("Admin/all_employes"); ?>">
                    <span>Members</span>
                    <div class="sb-nav-link-icon" hidden><img src="<?php echo base_url('admin-assets/img/add-user.png'); ?>" alt=""></div>
                </a>




                <!-- <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div> -->

            </div>
        </div>
       
    </nav>
</div>
<div class="abs-db-pass" hidden>
    <div class="close-db">
        <i class="fas fa-times"></i>
    </div>
    <h2>Keep This Secret</h2>
    <div>
        <strong>Host:</strong>
        <span>sdb-q.hosting.stackcp.net</span>
    </div>
    <div>
        <strong>User:</strong>
        <span>cloudtach_portal-3230350893</span>
    </div>
    <div>
        <strong>Pass:</strong>
        <span data-pass="h5zz9773q5">**********</span>
    </div>
</div>