<?php
/*
 * Created on Sat Jun 04 2022
 *
 * MartDevelopers - martmbithi.github.io 
 *
 * martdevelopers254@gmail.com
 *
 * From our local development environment to our deployment, production and live servers, 
 * at full throttle with no loss of data, fluctuations, signal interference or doubt it, 
 * can only be MART DEVELOPERS INC.
 *
 */
session_start();
require_once('../config/config.php');
require_once('../config/codeGen.php');
/* Handle Sign Up */
if (isset($_POST['register'])) {
    $login_rank = mysqli_real_escape_string($mysqli, $_POST['login_rank']);
    /* Process Farmer Sign Up */
    if ($login_rank == 'Farmer') {
        $farmer_name = mysqli_real_escape_string($mysqli, $_POST['farmer_name']);
        $farmer_email = mysqli_real_escape_string($mysqli, $_POST['farmer_email']);
        $farmer_phone = mysqli_real_escape_string($mysqli, $_POST['farmer_phone']);
        $farmer_address = mysqli_real_escape_string($mysqli, $_POST['farmer_address']);
        $farmer_login_id = mysqli_real_escape_string($mysqli, $sys_gen_id);
        $login_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['login_password'])));

        /*  Persist */
        $sql = "INSERT INTO farmer(farmer_name, farmer_email, farmer_phone, farmer_address, farmer_login_id) 
        VALUES('{$farmer_name}', '{$farmer_email}', '{$farmer_phone}', '{$farmer_address}', '{$farmer_login_id}')";
        $auth = "INSERT INTO login(login_id, login_name, login_password, login_rank)
        VALUES('{$farmer_login_id}', '{$farmer_email}', '{$login_password}', '{$login_rank}')";

        $prepare = $mysqli->prepare($sql);
        $auth_prepare = $mysqli->prepare($auth);

        $auth_prepare->execute();
        $prepare->execute();

        if ($prepare && $auth_prepare) {
            $success = "Account Created Successfully";
        } else {
            $err = "Failed!, Please Try Again";
        }
    } else {
        /* Process Customer Details */
        $customer_name = mysqli_real_escape_string($mysqli, $_POST['customer_name']);
        $customer_phone = mysqli_real_escape_string($mysqli, $_POST['customer_phone']);
        $customer_email = mysqli_real_escape_string($mysqli, $_POST['customer_email']);
        $customer_login_id  = mysqli_real_escape_string($mysqli, $sys_gen_id_alt_1);
        $login_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['login_password'])));

        /* Persist */
        $sql = "INSERT INTO customer (customer_name, customer_phone, customer_email, customer_login_id)
        VALUES('{$customer_name}', '{$customer_phone}', '{$customer_email}', '{$customer_login_id}')";
        $auth = "INSERT INTO login(login_id, login_name, login_password, login_rank)
        VALUES('{$customer_login_id}', '{$customer_email}', '{$login_password}', '{$login_rank}')";

        $prepare = $mysqli->prepare($sql);
        $auth_prepare = $mysqli->prepare($auth);

        $auth_prepare->execute();
        $prepare->execute();

        if ($prepare && $auth_prepare) {
            $success = "Account Created Successfully";
        } else {
            $err = "Failed!, Please Try Again";
        }
    }
}
require_once('../partials/head.php');
?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Online Farmers Market Platform</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="email" required name="login_name" class="form-control" placeholder="Login Name / Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-tag"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" required name="login_password" class="form-control" placeholder="Login Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <a href="reset_password">Reset Password</a>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="login" class="btn btn-primary btn-block">Log In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <hr>
                <p class="mb-2">
                <div class="social-auth-links text-center mb-3">
                    <a data-toggle="modal" href="#farmer_signup" class="btn btn-block btn-primary">
                        Sign Up As Farmer
                    </a>
                    <a data-toggle="modal" href="#customer_signup" class="btn btn-block btn-danger">
                        Sign Up As Customer
                    </a>
                </div>
            </div>
        </div>
        <!-- /.login-card-body -->
    </div>
    <!-- /.login-box -->

    <!-- Sign Up Modals -->
    <div class="modal fade" id="farmer_signup">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Register New Farmer Account</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Full Name</label>
                                <input type="text" name="farmer_name" required class="form-control">
                                <input type="hidden" value="Farmer" name="login_rank" required class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" name="farmer_email" required class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Phone Number</label>
                                <input type="text" name="farmer_phone" required class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Login Password</label>
                                <input type="password" name="login_password" required class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Address</label>
                                <textarea type="text" name="farmer_address" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="text-right">
                            <button name="register" class="btn btn-primary" type="submit">
                                Register Farmer Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Customer Modal -->
    <div class="modal fade" id="customer_signup">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Register New Customer Account</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Full Name</label>
                                <input type="text" name="customer_name" required class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" name="customer_email" required class="form-control">
                                <input type="hidden" value="Customer" name="login_rank" required class="form-control">

                            </div>
                            <div class="form-group col-md-6">
                                <label>Phone Number</label>
                                <input type="text" name="customer_phone" required class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Login Password</label>
                                <input type="password" name="login_password" required class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="text-right">
                            <button name="register" class="btn btn-primary" type="submit">
                                Register Customer Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Sign Up Modals -->

    <?php require_once('../partials/scripts.php'); ?>
</body>


</html>