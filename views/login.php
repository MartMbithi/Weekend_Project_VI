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
                        <input type="email" name="login_name" class="form-control" placeholder="Login Name / Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-tag"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="login_password" class="form-control" placeholder="Login Password">
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
                    <a href="sign_up?rank=Farmer" class="btn btn-block btn-primary">
                        Sign Up As Farmer
                    </a>
                    <a href="sign_up?rank=Customer" class="btn btn-block btn-danger">
                        Sign Up As Customer
                    </a>
                </div>
            </div>
        </div>
        <!-- /.login-card-body -->
    </div>
    <!-- /.login-box -->

    <?php require_once('../partials/scripts.php'); ?>
</body>


</html>