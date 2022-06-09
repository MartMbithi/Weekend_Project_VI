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
require_once('../partials/analytics.php');
require_once('../partials/head.php');
?>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php require_once('../partials/customer_nav.php');
        $customer = $_SESSION['login_id'];
        $ret = "SELECT * FROM customer WHERE customer_login_id = '{$customer}'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($cus = $res->fetch_object()) {
            $customer_id = $cus->customer_id;
        ?>
            <!-- /.navbar -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"> Hello, <?php echo $cus->customer_name; ?></h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Customer Dashboard</li>
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
                            <div class="col-12 col-sm-6 col-md-3">
                                <a href="customer_orders" class="text-dark">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-exclamation-triangle"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Unpaid Orders</span>
                                            <span class="info-box-number"><?php echo $pending; ?></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </a>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <a href="customer_orders" class="text-dark">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Paid Orders</span>
                                            <span class="info-box-number"><?php echo $paid; ?></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </a>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <a href="customer_orders" class="text-dark">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-clipboard-list"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Orders</span>
                                            <span class="info-box-number"><?php echo $orders; ?></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </a>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <a href="customer_payments" class="text-dark">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill-alt"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Overall Expenditure</span>
                                            <span class="info-box-number">Ksh <?php echo number_format($payments, 2); ?></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Recent Orders</h3>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table table-bordered text-truncate" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Order REF</th>
                                                    <th>Product Details</th>
                                                    <th>Farmer Details</th>
                                                    <th>QTY Ordered</th>
                                                    <th>Order Price</th>
                                                    <th>Order Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $ret = "SELECT * FROM `order` o 
                                                INNER JOIN order_items oi ON oi.order_item_order_id = o.order_id 
                                                INNER JOIN farmer_products fp ON fp.farmer_product_id = oi.order_item_farmer_product_id
                                                INNER JOIN products p ON p.product_id = fp.farmer_product_product_id
                                                INNER JOIN farmer f ON f.farmer_id = fp.farmer_product_farmer_id
                                                WHERE o.order_customer_id = '{$customer_id}'";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($orders = $res->fetch_object()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $orders->order_ref; ?></td>
                                                        <td><?php echo $orders->product_name; ?></td>
                                                        <td>
                                                            Name: <?php echo $orders->farmer_name; ?> <br>
                                                            Phone No: <?php echo $orders->farmer_phone; ?>
                                                        </td>
                                                        <td><?php echo $orders->order_item_quantity_ordered; ?></td>
                                                        <td>Ksh <?php echo number_format(($orders->order_item_quantity_ordered * $orders->farmer_product_price), 2); ?></td>
                                                        <td>
                                                            <?php
                                                            if ($orders->order_status == 'Paid') {
                                                            ?>
                                                                <span class="badge  badge-pill badge-success">Paid</span>
                                                            <?php } else { ?>
                                                                <span class="badge  badge-pill badge-danger">Pending</span>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
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