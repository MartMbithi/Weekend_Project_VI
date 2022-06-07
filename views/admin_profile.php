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

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php require_once('../partials/navbar.php'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require_once('../partials/aside.php');
        $login_id = $_SESSION['login_id'];
        $ret = "SELECT * FROM login WHERE login_id = '{$login_id}'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($user = $res->fetch_object()) {
        ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Profile</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="admin_home">Home</a></li>
                                    <li class="breadcrumb-item active">User Profile</li>
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
                                        <h3 class="card-title">Update Authentication Details</h3>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <form method="post" enctype="multipart/form-data" role="form">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="">Login Name</label>
                                                    <input type="text" required name="login_name" value="<?php echo $user->login_name; ?>" class="form-control">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="">Old Password</label>
                                                    <input type="password" required name="old_password" class="form-control">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="">New Password</label>
                                                    <input type="password" required name="new_password" class="form-control">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="">Confirm New Password</label>
                                                    <input type="password" required name="confirm_password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" name="update_profile" class="btn btn-primary">Update Authentication Details</button>
                                            </div>
                                        </form>
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
        <?php } ?>
        <!-- /.content-wrapper -->
        <?php require_once('../partials/footer.php'); ?>

    </div>
    <!-- ./wrapper -->

    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>