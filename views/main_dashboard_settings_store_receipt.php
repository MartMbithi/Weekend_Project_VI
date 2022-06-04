<?php
/*
 * Created on Fri May 20 2022
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
require_once('../config/checklogin.php');
require_once('../config/codeGen.php');
check_login();
/* Update Receipt Header And Footer */
if (isset($_POST['update_receipt_settings'])) {
    $receipt_store_id = mysqli_real_escape_string($mysqli, $_GET['store']);
    $receipt_header_content = mysqli_real_escape_string($mysqli, $_POST['receipt_header_content']);
    $receipt_footer_content = mysqli_real_escape_string($mysqli, $_POST['receipt_footer_content']);
    $receipt_show_barcode = mysqli_real_escape_string($mysqli, $_POST['receipt_show_barcode']);
    $show_customer = mysqli_real_escape_string($mysqli, $_POST['show_customer']);
    $allow_discounts = mysqli_real_escape_string($mysqli, $_POST['allow_discounts']);
    $allow_loyalty_points = mysqli_real_escape_string($mysqli, $_POST['allow_loyalty_points']);

    /* Log Details */
    $log_type = "Settings & Configurations Logs";
    $log_details = "Edited Receipt & Sales Customizations";

    /* Persist */
    $sql = "UPDATE receipt_customization SET receipt_store_id = '{$receipt_store_id}', receipt_header_content = '{$receipt_header_content}',
    receipt_footer_content = '{$receipt_footer_content}', receipt_show_barcode = '{$receipt_show_barcode}', show_customer = '{$show_customer}',
    allow_discounts = '{$allow_discounts}', allow_loyalty_points = '{$allow_loyalty_points}' WHERE receipt_store_id = '{$receipt_store_id}'";
    $prepare = $mysqli->prepare($sql);
    $prepare->execute();
    /* Load Logs */
    include('../functions/logs.php');

    if ($prepare) {
        $success = "Receipt Customizations Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}
require_once('../partials/head.php');
?>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <?php require_once('../partials/sidebar.php'); ?>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <?php require_once('../partials/header.php'); ?>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Sales Receipt Customizations</h3>
                                            <div class="nk-block-des text-soft">
                                                <p>This module allows you to customize receipt header, footer and barcodes on sales receipt</p>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="row g-gs">

                                        <div class="col-md-6 col-xxl-4">
                                            <div class="card card-bordered h-100 border border-success">
                                                <div class="card-inner border-bottom">
                                                    <div class="card-title-group">
                                                        <div class="card-title">
                                                            <h6 class="title">Edit Sales Receipt & Core Sales Module Configurations</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-inner">
                                                    <div class="timeline">
                                                        <form method="post" enctype="multipart/form-data">
                                                            <?php
                                                            /*  Store Details */
                                                            $store = $_GET['store'];
                                                            $ret = "SELECT * FROM receipt_customization rc INNER JOIN store_settings st ON st.store_id = rc.receipt_store_id 
                                                            WHERE st.store_status ='active' AND st.store_id = '{$store}'";
                                                            $stmt = $mysqli->prepare($ret);
                                                            $stmt->execute(); //ok
                                                            $res = $stmt->get_result();
                                                            while ($receipt_conf = $res->fetch_object()) {
                                                            ?>

                                                                <div class="form-row">
                                                                    <div class="form-group col-md-12">
                                                                        <label>Receipt Header Details</label>
                                                                        <textarea type="text" required name="receipt_header_content" rows="2" class="form-control"><?php echo $receipt_conf->receipt_header_content; ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-12">
                                                                        <label>Receipt Footer Details</label>
                                                                        <textarea type="text" name="receipt_footer_content" rows="2" class="form-control"><?php echo $receipt_conf->receipt_footer_content; ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label>Show Barcode On Receipts</label>
                                                                        <div class="form-control-wrap">
                                                                            <div class="form-group">
                                                                                <div class="form-control-wrap">
                                                                                    <select name="receipt_show_barcode" class="form-select form-control form-control-lg" data-search="on">
                                                                                        <?php if ($receipt_conf->receipt_show_barcode  == 'true') { ?>
                                                                                            <option value="true">Enabled</option>
                                                                                            <option value="false">Disabled</option>
                                                                                        <?php } else { ?>
                                                                                            <option value="false">Disabled</option>
                                                                                            <option value="true">Enabled</option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Award Loyalty Points</label>
                                                                        <div class="form-control-wrap">
                                                                            <div class="form-group">
                                                                                <div class="form-control-wrap">
                                                                                    <select name="allow_loyalty_points" class="form-select form-control form-control-lg" data-search="on">
                                                                                        <?php if ($receipt_conf->allow_loyalty_points  == 'true') { ?>
                                                                                            <option value="true">Enabled</option>
                                                                                            <option value="false">Disabled</option>
                                                                                        <?php } else { ?>
                                                                                            <option value="false">Disabled</option>
                                                                                            <option value="true">Enabled</option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Show Customer Details</label>
                                                                        <div class="form-control-wrap">
                                                                            <div class="form-group">
                                                                                <div class="form-control-wrap">
                                                                                    <select name="show_customer" class="form-select form-control form-control-lg" data-search="on">
                                                                                        <?php if ($receipt_conf->show_customer  == 'true') { ?>
                                                                                            <option value="true">Enabled</option>
                                                                                            <option value="false">Disabled</option>
                                                                                        <?php } else { ?>
                                                                                            <option value="false">Disabled</option>
                                                                                            <option value="true">Enabled</option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Allow Discounts On Sales</label>
                                                                        <div class="form-control-wrap">
                                                                            <div class="form-group">
                                                                                <div class="form-control-wrap">
                                                                                    <select name="allow_discounts" class="form-select form-control form-control-lg" data-search="on">
                                                                                        <?php if ($receipt_conf->allow_discounts  == 'true') { ?>
                                                                                            <option value="true">Active</option>
                                                                                            <option value="false">Disabled</option>
                                                                                        <?php } else { ?>
                                                                                            <option value="false">Disabled</option>
                                                                                            <option value="true">Enabled</option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                            <br>
                                                            <div class="text-right">
                                                                <button name="update_receipt_settings" class="btn btn-primary" type="submit">
                                                                    <em class="icon ni ni-update"></em> Update Configurations
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div><!-- .col -->
                                        <div class="col-xl-6 col-xxl-8">
                                            <div class="card card-bordered card-full border border-success">
                                                <div class="card-inner border-bottom">
                                                    <div class="card-title-group">
                                                        <div class="card-title">
                                                            <h6 class="title">Sales Receipt Preview</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-list">
                                                    <div class="nk-tb-item">
                                                        <div class="card-body">
                                                            <div>
                                                                <style>
                                                                    .heading {
                                                                        letter-spacing: 1px;
                                                                        text-align: center;
                                                                    }
                                                                </style>
                                                                <h4 class="heading" style="font-size:10pt">
                                                                    <?php
                                                                    $store = $_GET['store'];
                                                                    $raw_results = mysqli_query(
                                                                        $mysqli,
                                                                        "SELECT * FROM receipt_customization rc
                                                                        INNER JOIN store_settings ss ON ss.store_id = rc.receipt_store_id
                                                                        WHERE ss.store_status = 'active' AND ss.store_id = '{$store}'"
                                                                    );
                                                                    if (mysqli_num_rows($raw_results) > 0) {
                                                                        while ($receipts_header = mysqli_fetch_array($raw_results)) {
                                                                    ?>
                                                                            <strong>
                                                                                <?php echo $receipts_header['receipt_header_content']; ?>
                                                                                Receipt No. <?php echo $b; ?> <br>
                                                                                <?php if ($receipts_header['show_customer'] == 'true') { ?>
                                                                                    Customer : Test Customer <br>
                                                                                <?php } ?>
                                                                                Date: <?php echo date('d M Y H:i'); ?>
                                                                            </strong>
                                                                            <br><br>
                                                                    <?php
                                                                            /* Show Barcode */
                                                                            if ($receipts_header['receipt_show_barcode'] == 'true') {
                                                                                echo "<img alt='barcode' src='../functions/barcode.php?codetype=Code39&size=20&text=" . $b . "&print=true'/>";
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </h4>
                                                            </div>
                                                            <hr>
                                                            <table cellspacing="5" style="font-size:8.4pt">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="text-align:left;" width="2%">SL</th>
                                                                        <th width="100%" style="text-align:left;"><strong>ITEM DETAILS</strong></th>
                                                                        <th width="100%" style="text-align:right;"><strong>TOTAL</strong></th>
                                                                    </tr>
                                                                </thead>
                                                                <?php
                                                                $test_product = "THIS IS A TEST ITEM";
                                                                $test_product_price = "100";
                                                                $test_qty = '5';
                                                                $total = 0;
                                                                $cnt = 1;
                                                                while ($cnt <= 5) {
                                                                ?>
                                                                    <tr>
                                                                        <td style="text-align:left;"><strong><?php echo $cnt; ?></strong></td>
                                                                        <td style="text-align:left; overflow-wrap: break-word">
                                                                            <strong>
                                                                                <?php echo $test_product; ?> <br>
                                                                                <?php echo $test_qty . ' X Ksh' . number_format($test_product_price, 2); ?>
                                                                            </strong>
                                                                        </td>
                                                                        <td style="text-align:right;"><strong>Ksh <?php echo number_format(($test_qty * $test_product_price), 2); ?></strong></td>
                                                                    </tr>
                                                                <?php
                                                                    $cnt++;
                                                                    $total += ($test_qty * $test_product_price);
                                                                } ?>
                                                                <tr>
                                                                    <td colspan="1"><strong>TOTAL:</strong></td>
                                                                    <td style="text-align:right;" colspan="2"><strong>Ksh <?php echo number_format($total, 2); ?></strong></td>
                                                                </tr>
                                                            </table>
                                                            <hr>
                                                            <?php
                                                            $store = $_GET['store'];
                                                            $raw_results = mysqli_query(
                                                                $mysqli,
                                                                "SELECT * FROM receipt_customization rc
                                                                INNER JOIN store_settings ss ON ss.store_id = rc.receipt_store_id
                                                                WHERE ss.store_status = 'active' AND ss.store_id = '{$store}'"
                                                            );
                                                            if (mysqli_num_rows($raw_results) > 0) {
                                                                while ($receipts_header = mysqli_fetch_array($raw_results)) {
                                                                    /* Load Loyalty Points  */
                                                                    include('../functions/loyalty_points.php');
                                                            ?>
                                                                    <p align="center"><strong>You Were Served By Staff Name<strong></p>
                                                                    <p align="center"><i><?php echo $receipts_header['receipt_footer_content']; ?></i></p>
                                                                    <?php if ($receipts_header['allow_loyalty_points'] == 'true') { ?>
                                                                        <hr>
                                                                        <p align="center">
                                                                            <strong>Loyalty Point # <?php echo $a . $b; ?><br>
                                                                                Loyalty Points Credited : <?php echo  $points_awarded; ?> Points
                                                                                <strong>
                                                                        </p>
                                                                    <?php } ?>
                                                            <?php }
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div><!-- .col -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                <?php require_once('../partials/footer.php'); ?>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <?php
    require_once('../partials/scripts.php');
    ?>
</body>

</html>