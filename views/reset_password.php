<?php
/*
 * Created on Thu May 12 2022
 *
 * Devlan Solutions LTD - www.devlan.co.ke 
 *
 * hello@devlan.co.ke
 *
 *
 * The Devlan Solutions LTD End User License Agreement
 *
 * Copyright (c) 2022 Devlan Solutions LTD
 *
 * 1. GRANT OF LICENSE
 * Devlan Solutions LTD hereby grants to you (an individual) the revocable, personal, non-exclusive, and nontransferable right to
 * install and activate this system on two separated computers solely for your personal and non-commercial use,
 * unless you have purchased a commercial license from Devlan Solutions LTD. Sharing this Software with other individuals, 
 * or allowing other individuals to view the contents of this Software, is in violation of this license.
 * You may not make the Software available on a network, or in any way provide the Software to multiple users
 * unless you have first purchased at least a multi-user license from Devlan Solutions LTD.
 *
 * 2. COPYRIGHT 
 * The Software is owned by Devlan Solutions LTD and protected by copyright law and international copyright treaties. 
 * You may not remove or conceal any proprietary notices, labels or marks from the Software.
 *
 * 3. RESTRICTIONS ON USE
 * You may not, and you may not permit others to
 * (a) reverse engineer, decompile, decode, decrypt, disassemble, or in any way derive source code from, the Software;
 * (b) modify, distribute, or create derivative works of the Software;
 * (c) copy (other than one back-up copy), distribute, publicly display, transmit, sell, rent, lease or 
 * otherwise exploit the Software.  
 *
 * 4. TERM
 * This License is effective until terminated. 
 * You may terminate it at any time by destroying the Software, together with all copies thereof.
 * This License will also terminate if you fail to comply with any term or condition of this Agreement.
 * Upon such termination, you agree to destroy the Software, together with all copies thereof.
 *
 * 5. NO OTHER WARRANTIES. 
 * DEVLAN SOLUTIONS LTD DOES NOT WARRANT THAT THE SOFTWARE IS ERROR FREE. 
 * DEVLAN SOLUTIONS LTD SOFTWARE DISCLAIMS ALL OTHER WARRANTIES WITH RESPECT TO THE SOFTWARE, 
 * EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, 
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT OF THIRD PARTY RIGHTS. 
 * SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF IMPLIED WARRANTIES OR LIMITATIONS
 * ON HOW LONG AN IMPLIED WARRANTY MAY LAST, OR THE EXCLUSION OR LIMITATION OF 
 * INCIDENTAL OR CONSEQUENTIAL DAMAGES,
 * SO THE ABOVE LIMITATIONS OR EXCLUSIONS MAY NOT APPLY TO YOU. 
 * THIS WARRANTY GIVES YOU SPECIFIC LEGAL RIGHTS AND YOU MAY ALSO 
 * HAVE OTHER RIGHTS WHICH VARY FROM JURISDICTION TO JURISDICTION.
 *
 * 6. SEVERABILITY
 * In the event of invalidity of any provision of this license, the parties agree that such invalidity shall not
 * affect the validity of the remaining portions of this license.
 *
 * 7. NO LIABILITY FOR CONSEQUENTIAL DAMAGES IN NO EVENT SHALL DEVLAN SOLUTIONS LTD  OR ITS SUPPLIERS BE LIABLE TO YOU FOR ANY
 * CONSEQUENTIAL, SPECIAL, INCIDENTAL OR INDIRECT DAMAGES OF ANY KIND ARISING OUT OF THE DELIVERY, PERFORMANCE OR 
 * USE OF THE SOFTWARE, EVEN IF DEVLAN HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES
 * IN NO EVENT WILL DEVLAN  LIABILITY FOR ANY CLAIM, WHETHER IN CONTRACT 
 * TORT OR ANY OTHER THEORY OF LIABILITY, EXCEED THE LICENSE FEE PAID BY YOU, IF ANY.
 */
session_start();
require_once('../config/config.php');
require_once('../config/app_config.php');
require_once('../config/codeGen.php');

/* Handle Password Reset */
if (isset($_POST['ResetPassword'])) {
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $password_reset_token = $checksum;
    $reset_url  =  $url . $checksum . '&email=' . $user_email;
    /* Filter And Validate Email */
    if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($mysqli, "SELECT * FROM users WHERE user_email = '{$user_email}'");
        if (mysqli_num_rows($sql) > 0) {
            /* Persist Token And Email It */
            $sql = "UPDATE users SET  user_password_reset_token ='{$password_reset_token}' WHERE  user_email ='{$user_email}'";
            $prepare = $mysqli->prepare($sql);
            $prepare->execute();
            /* Detect Internet Connection First */
            switch (connection_status()) {
                case CONNECTION_NORMAL:
                    /* Load Mailer & Send Password Reset Instructions*/
                    require_once('../mailers/reset_password.php');
                    if ($prepare && $mail->send()) {
                        $success = "Password Reset Instructions Send To Your Email";
                    } else if (CONNECTION_ABORTED && CONNECTION_TIMEOUT) {
                        /* If No Connection Detected, Just Take User To Password Reset */
                        if ($prepare) {
                            $_SESSION['success'] = 'Confirm Your New Password';
                            header("Location: confirm_password?token=$password_reset_token");
                            exit;
                        } else {
                            $info = "Failed!, Please Try Again we there";
                        }
                    }
                    break;
                default:
                    /* Do Not Mail Just Take User To Password Reset  */
                    if ($prepare) {
                        $_SESSION['success'] = 'Confirm Your New Password';
                        header("Location: confirm_password?token=$password_reset_token");
                        exit;
                    } else {
                        $err = "Please Check Your Internet Connectivity atuko";
                    }
                    break;
            }
        } else {
            $err =  "No Account With This Email";
        }
    }
}
require_once('../partials/head.php');
?>

<body class="nk-body npc-crypto ui-clean pg-auth">
    <!-- app body @s -->
    <?php
    /* Wrap All This With System Settings */
    $ret = "SELECT * FROM  system_settings";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($settings = $res->fetch_object()) {
    ?>
        <div class="nk-app-root">
            <div class="nk-split nk-split-page nk-split-md">
                <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container">
                    <div class="nk-block nk-block-middle nk-auth-body">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title">Reset Password</h5>
                                <div class="nk-block-des">
                                    <p>Having Troubles Accessing <?php echo $settings->system_name; ?>? Enter Your Email To Reset Password</p>
                                </div>
                            </div>
                        </div><!-- .nk-block-head -->
                        <form method="POST">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label" for="password">Email Address</label>
                                    <a class="link link-primary link-sm" tabindex="-1" href="index">Remember Password</a>
                                </div>
                                <div class="form-control-wrap">
                                    <input type="email" name="user_email" class="form-control form-control-lg" id="default-01">
                                </div>
                            </div><!-- .foem-group -->
                            <div class="form-group">
                                <button name="ResetPassword" class="btn btn-lg btn-primary btn-block">Reset Password</button>
                            </div>
                        </form><!-- form -->
                    </div><!-- .nk-block -->
                </div><!-- .nk-split-content -->
                <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
                    <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
                        <div class="slider-init">
                            <div class="slider-item">
                                <div class="nk-feature nk-feature-center">
                                    <div class="nk-feature-img">
                                        <img class="round" src="../public/images/logo.png" alt="">
                                    </div>
                                    <div class="nk-feature-content py-4 p-sm-5">
                                        <h4><?php echo $settings->system_name; ?></h4>
                                        <p><?php echo $settings->system_tagline; ?></p>
                                    </div>
                                </div>
                            </div><!-- .slider-item -->
                        </div><!-- .slider-init -->
                    </div><!-- .slider-wrap -->
                </div><!-- .nk-split-content -->
            </div><!-- .nk-split -->
        </div><!-- app body @e -->
    <?php } ?>
    <!-- JavaScript -->
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>