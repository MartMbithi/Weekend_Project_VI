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
require_once('../config/dbcontroller.php');
require_once('../config/checklogin.php');
require_once('../config/codeGen.php');
check_login();
require_once('../partials/head.php');

?>
<link href="../public/css/cart.css" type="text/css" rel="stylesheet" />

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
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
                            <h1>Order <?php echo $_GET['ref']; ?> Details</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="admin_home">Home</a></li>
                                <li class="breadcrumb-item"><a href="admin_orders">Orders</a></li>
                                <li class="breadcrumb-item active"><?php echo $_GET['ref']; ?></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header p-2">
                                    <h3 class="text-center">
                                        Customer Details
                                    </h3>
                                </div><!-- /.card-header -->

                                <!-- /.nav-tabs-custom -->
                                <?php
                                $ret = "SELECT * FROM order_items ot
                                INNER JOIN `order` o ON o.order_id = ot.order_item_order_id
                                INNER JOIN customer c ON c.customer_id = o.order_customer_id
                                WHERE  o.order_ref = '{$_GET['ref']}'";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($customer = $res->fetch_object()) {
                                ?>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="card-body box-profile">
                                                <div class="text-center">
                                                    <img class="profile-user-img img-fluid img-circle" src="../public/images/no-profile.png" alt="User profile picture">
                                                </div>

                                                <h3 class="profile-username text-center"><?php echo $customer->customer_name; ?></h3>


                                                <ul class="list-group list-group-unbordered mb-3">
                                                    <li class="list-group-item">
                                                        <b>Phone: </b> <a class="float-right"><?php echo $customer->customer_phone; ?></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Email: </b> <a class="float-right"><?php echo $customer->customer_email; ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header p-2">
                                    <h3 class="text-center">
                                        Payment Details
                                    </h3>
                                </div><!-- /.card-header -->

                                <!-- /.nav-tabs-custom -->
                                <?php
                                $ret = "SELECT * FROM payment p WHERE p.payment_order_id = '{$_GET['order']}'";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($payment = $res->fetch_object()) {
                                ?>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="card-body box-profile">
                                                <h3 class="profile-username text-center text-success"><?php echo $payment->payment_ref; ?></h3>
                                                <ul class="list-group list-group-unbordered mb-3">
                                                    <li class="list-group-item">
                                                        <b>Mode Of Payment: </b> <a class="float-right"><?php echo $payment->payment_type; ?></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Date: </b> <a class="float-right"><?php echo date('d M Y g:ia', strtotime($payment->payment_date)); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header p-2">
                                    <h3 class="text-center">
                                        Order Product Details
                                    </h3>
                                </div><!-- /.card-header -->

                                <!-- /.nav-tabs-custom -->
                                <div class="card-body">
                                    <table class="table table-bordered text-truncate" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Product Details</th>
                                                <th>Farmer Details</th>
                                                <th>Order Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ret = "SELECT * FROM order_items oi 
                                            INNER JOIN `order` o ON o.order_id = oi.order_item_order_id
                                            INNER JOIN farmer_products fp ON oi.order_item_farmer_product_id
                                            INNER JOIN products p ON p.product_id  = fp.farmer_product_product_id 
                                            INNER JOIN farmer f ON f.farmer_id = fp.farmer_product_farmer_id
                                            WHERE o.order_ref = '{$_GET['ref']}'";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($product = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $product->product_name; ?>
                                                    </td>
                                                    <td>
                                                        <b>Name: </b> <?php echo $product->farmer_name; ?> <br>
                                                        <b>Contacts: </b> <?php echo $product->farmer_phone; ?>
                                                    </td>
                                                    <td>
                                                        <b>Qty Ordered: </b><?php echo $product->order_item_quantity_ordered; ?><br>
                                                        <b>Item Cost: </b>Ksh <?php echo number_format($product->order_item_cost, 2); ?>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
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