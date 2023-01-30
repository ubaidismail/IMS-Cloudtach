<?php
defined('BASEPATH') or exit('No direct script access allowed');
include "inc/header.php";
?>

<body>
    <?php include "inc/nav.php"; ?>

    <div id="layoutSidenav">
        <?php include "inc/sidenav.php"; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Employee List</h1>
                    <div class="add-emp">
                        <a href="<?php echo site_url("AdminController/add_employes"); ?>">Add Employee <i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                    <table class="display nowrap simple-table" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sno = 0;
                        foreach ($data as $d) {
                            $sno++;
                        ?>
                            <tr>
                                <td><?php echo $sno; ?></td>
                                <td><?php echo $d->name; ?></td>
                                <td><?php echo $d->email; ?></td>
                                <td><?php echo $d->user_role; ?></td>
                            </tr>

                        <?php
                        }
                        ?>
                        <tbody>
                        <tfoot>
                                <tr>
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </tfoot>
                    </table>
                </div>
            </main>
            <?php
            include "inc/footer.php";
            ?>