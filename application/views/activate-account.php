<?php
defined('BASEPATH') or exit('Your are not allowed to access this asset');
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

<body>
    <?php
    if (!empty($data)) {
    ?>
        <div class="email_activated">
        <img src="<?php echo base_url('admin-assets/img/email.png'); ?>" alt="">
            <h1>Email Verified</h1>
            <p>Thank You For Verification</p>
            <a href="https://dashboard.cloudtach.com/" class="btn btn-primary">Login</a>
        </div>
    <?php
    }


    ?>
</body>

</html>