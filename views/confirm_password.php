<?php
/*
 * Created on Sun Jun 05 2022
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
if (isset($_POST['reset_password'])) {
    $login_email = mysqli_real_escape_string($mysqli, $_SESSION['login_email']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));
    /* Check If These Match */
    if ($new_password != $confirm_password) {
        $err = "Passwords Does Not Match";
    } else {
        $sql = "UPDATE login SET login_password = '{$confirm_password}' WHERE login_name = '{$login_email}'";
        $prepare = $mysqli->prepare($sql);
        $prepare->execute();
        if ($prepare) {
            /* Redirect User To Confirm Password */
            $_SESSION['success'] = 'Password Reset, Proceed To Login';
            header('Location: login');
            exit;
        } else {
            $err = "Failed!, Please Try Again";
        }
    }
}
require_once('../partials/head.php');

?>

<body class="hold-transition login-page" style="background-image: url('../public/images/landing/img_9.jpg'); background-repeat: no-repeat; background-size: cover; ">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="login-logo">
            <a href="" class="text-light"><b>Online Farmers Market Platform</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body border border-success">
                <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="password" required name="new_password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" required name="confirm_password" class="form-control" placeholder="Confirm Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" name="reset_password" class="btn btn-primary btn-block">Change password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <?php require_once('../partials/scripts.php'); ?>

</body>


</html>