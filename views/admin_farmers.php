<?php
/*
 * Created on Mon Jun 06 2022
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
require_once('../config/checklogin.php');
check_login();
/* Add Farmer */
if (isset($_POST['register_farmer'])) {
    $login_rank = mysqli_real_escape_string($mysqli, $_POST['login_rank']);
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
}

/* Update Farmer */
if (isset($_POST['update_farmer'])) {
    $farmer_id = mysqli_real_escape_string($mysqli, $_POST['farmer_id']);
    $farmer_name = mysqli_real_escape_string($mysqli, $_POST['farmer_name']);
    $farmer_email = mysqli_real_escape_string($mysqli, $_POST['farmer_email']);
    $farmer_phone = mysqli_real_escape_string($mysqli, $_POST['farmer_phone']);
    $farmer_address = mysqli_real_escape_string($mysqli, $_POST['farmer_address']);

    /* Persist */
    $sql = "UPDATE farmer SET farmer_name = '{$farmer_name}', farmer_email = '{$farmer_email}', farmer_phone = '{$farmer_phone}',
    farmer_address = '{$farmer_address}' WHERE farmer_id = '{$farmer_id}'";
    $prepare = $mysqli->prepare($sql);
    $prepare->execute();
    if ($prepare) {
        $success = "Farmer Account Updated";
    } else {
        $err  = "Failed!, Please Try Again";
    }
}
/* Delete Farmer */
require_once('../partials/head.php');
?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php require_once('../partials/navbar.php'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require_once('../partials/aside.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Farmers</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="admin_dashboard">Home</a></li>
                                <li class="breadcrumb-item"><a href="admin_dashboard">Users</a></li>
                                <li class="breadcrumb-item active">Farmers</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header p-2">
                                    <h3 class="text-right">
                                        <button type="button" data-toggle="modal" data-target="#add_modal" class="btn btn-success"> Register New Farmer</button>
                                    </h3>
                                </div><!-- /.card-header -->
                                <!-- Add Farmer Modal -->
                                <div class="modal fade" id="add_modal">
                                    <div class="modal-dialog modal-dialog-centered  modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Register New Farmer Account - Fill All Required Fields </h4>
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
                                                        <button name="register_farmer" class="btn btn-primary" type="submit">
                                                            Register Farmer Account
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php require_once('../partials/footer.php'); ?>

    </div>
    <!-- ./wrapper -->

    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>