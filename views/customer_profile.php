<?php
/*
 * Created on Thu Jun 09 2022
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
/* Update Customer */
if (isset($_POST['update_customer'])) {
    $customer_id = mysqli_real_escape_string($mysqli, $_POST['customer_id']);
    $customer_name = mysqli_real_escape_string($mysqli, $_POST['customer_name']);
    $customer_phone = mysqli_real_escape_string($mysqli, $_POST['customer_phone']);
    $customer_email = mysqli_real_escape_string($mysqli, $_POST['customer_email']);

    /* Persist */
    $sql = "UPDATE customer SET customer_name = '{$customer_name}', customer_phone = '{$customer_phone}', customer_email = '{$customer_email}'
    WHERE customer_id = '{$customer_id}'";
    $prepare = $mysqli->prepare($sql);
    $prepare->execute();
    if ($prepare) {
        $success = "Account Details Updated Successfully";
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Update Login Details*/
if (isset($_POST['update_profile'])) {
    $login_name = mysqli_real_escape_string($mysqli, $_POST['login_name']);
    $login_id = mysqli_real_escape_string($mysqli, $_SESSION['login_id']);
    $old_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['old_password'])));
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        $err  = "Confirmation Passwords Does Not Match";
    } else {
        /* Check If Old Password Matches */
        $sql = "SELECT * FROM  login WHERE login_id = '{$login_id}'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($old_password != $row['login_password']) {
                $err =  "Please Enter Correct Old Password";
            } else {
                /* Update Login Details */
                $sql = "UPDATE login SET login_name = '{$login_name}', login_password = '{$confirm_password}' WHERE login_id = '{$login_id}'";
                $prepare = $mysqli->prepare($sql);
                $prepare->execute();
                if ($prepare) {
                    $success  = "Authentication Details Updated";
                } else {
                    $err  = "Failed!, Please Try Again";
                }
            }
        }
    }
}
require_once('../partials/head.php');
?>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php require_once('../partials/customer_nav.php');
        $customer = $_SESSION['login_id'];
        $ret = "SELECT * FROM customer c
        INNER JOIN login l ON l.login_id = c.customer_login_id
        WHERE c.customer_login_id = '{$customer}'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($user = $res->fetch_object()) {
        ?>
            <!-- /.navbar -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"> Profile Settings</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="customer_home">Home</a></li>
                                    <li class="breadcrumb-item active">Profile Settings</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <div class="card card-primary card-outline">
                                    <div class="card-header p-2">
                                        <h3 class="card-title">Update Personal Info</h3>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Full Name</label>
                                                    <input value="<?php echo $user->customer_id; ?>" type="hidden" name="customer_id" required class="form-control">
                                                    <input value="<?php echo $user->customer_name; ?>" type="text" name="customer_name" required class="form-control">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Email</label>
                                                    <input type="email" value="<?php echo $user->customer_email; ?>" name="customer_email" required class="form-control">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Phone Number</label>
                                                    <input type="text" value="<?php echo $user->customer_phone; ?>" name="customer_phone" required class="form-control">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-right">
                                                <button name="update_customer" class="btn btn-primary" type="submit">
                                                    Update Account
                                                </button>
                                            </div>
                                        </form>
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.nav-tabs-custom -->
                            </div>
                            <div class="col-6">
                                <div class="card card-primary card-outline">
                                    <div class="card-header p-2">
                                        <h3 class="card-title">Update Authentication Details</h3>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <form method="post" enctype="multipart/form-data" role="form">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="">Login Name</label>
                                                    <input type="text" required name="login_name" value="<?php echo $user->login_name; ?>" class="form-control">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="">Old Password</label>
                                                    <input type="password" required name="old_password" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">New Password</label>
                                                    <input type="password" required name="new_password" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Confirm New Password</label>
                                                    <input type="password" required name="confirm_password" class="form-control">
                                                </div>
                                            </div><br>
                                            <div class="text-right">
                                                <button type="submit" name="update_profile" class="btn btn-primary">Update Authentication Details</button>
                                            </div>
                                        </form>
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.nav-tabs-custom -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

        <?php } ?>

        <!-- Main Footer -->
        <?php require_once('../partials/footer.php'); ?>
    </div>
    <!-- ./wrapper -->
    <?php require_once('../partials/scripts.php'); ?>
</body>


</html>