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
require_once('../config/codeGen.php');
check_login();
/* Add Order */
if (isset($_POST['add_order'])) {
    $order_ref = mysqli_real_escape_string($mysqli, $a . $b);
    $order_status = mysqli_real_escape_string($mysqli, 'Pending');
    $order_customer_id = mysqli_real_escape_string($mysqli, $_POST['order_customer_id']);

    /* Persist */
    $sql = "INSERT INTO `order`(order_ref, order_status, order_customer_id)
    VALUES('{$order_ref}', '{$order_status}', '{$order_customer_id}')";
    $prepare = $mysqli->prepare($sql);
    $prepare->execute();
    if ($prepare) {
        $_SESSION['success'] = 'Order Added, Proceed To Add Products Into Your Order';
        header("Location: customer_add_order_products?ref=$order_ref");
        exit;
    } else {
        $err = "Failed!, Please Try Again";
    }
}
/* Delete Order */
if (isset($_POST['delete_order'])) {
    $order_id = mysqli_real_escape_string($mysqli, $_POST['order_id']);

    /* Persist */
    $sql = "DELETE FROM `order` WHERE order_id = '{$order_id}'";
    $prepare = $mysqli->prepare($sql);
    $prepare->execute();
    if ($prepare) {
        $success = "Order Deleted";
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Pay Order */
if (isset($_POST['pay_order'])) {
    $payment_type = mysqli_real_escape_string($mysqli, $_POST['payment_type']);
    $payment_ref = mysqli_real_escape_string($mysqli, $_POST['payment_ref']);
    $payment_order_id = mysqli_real_escape_string($mysqli, $_POST['payment_order_id']);
    $order_status = mysqli_real_escape_string($mysqli, 'Paid');

    /* Persist */
    $sql = "INSERT INTO payment(payment_type, payment_ref, payment_order_id)
    VALUES(
        '{$payment_type}',
        '{$payment_ref}',
        '{$payment_order_id}'
    )";
    $status = "UPDATE `order` SET order_status = '{$order_status}' WHERE order_id = '{$payment_order_id}'";

    $prepare = $mysqli->prepare($sql);
    $order_prepare = $mysqli->prepare($status);

    $prepare->execute();
    $order_prepare->execute();

    if ($prepare && $order_prepare) {
        $success = "Order Payment Posted";
    } else {
        $err = "Failed!, Please Try Again";
    }
}
require_once('../partials/head.php');
?>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php require_once('../partials/customer_nav.php');
        $customer = $_SESSION['login_id'];
        $ret = "SELECT * FROM customer WHERE 
        customer_login_id = '{$customer}'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($user = $res->fetch_object()) {
            $customer_id = $user->customer_id;
        ?>
            <!-- /.navbar -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"> Order <?php echo $_GET['ref']; ?> Details</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="customer_home">Home</a></li>
                                    <li class="breadcrumb-item"><a href="customer_orders">Order</a></li>
                                    <li class="breadcrumb-item active">Orders Details</li>
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
                            <div class="col-md-6">
                                <div class="card card-primary card-outline">
                                    <div class="card-header p-2">
                                        <h3 class="text-center">
                                            Customer Details
                                        </h3>
                                    </div><!-- /.card-header -->

                                    <!-- /.nav-tabs-custom -->
                                    <?php
                                    $ret = "SELECT * FROM  `order` o 
                                    INNER JOIN customer c ON c.customer_id = o.order_customer_id
                                    WHERE  o.order_id = '{$_GET['order']}'";
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
                                        $ret = "SELECT * FROM order_items oi 
                                        INNER JOIN `order` o ON o.order_id = oi.order_item_order_id
                                        INNER JOIN farmer_products fp ON fp.farmer_product_id = oi.order_item_farmer_product_id
                                        INNER JOIN products p ON p.product_id  = fp.farmer_product_product_id 
                                        INNER JOIN farmer f ON f.farmer_id = fp.farmer_product_farmer_id
                                        WHERE o.order_id = '{$_GET['order']}'";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        $total_paid = 0;
                                        while ($product = $res->fetch_object()) {
                                            /* Compute Total Payable Amout */
                                            $unit_paid = ($product->order_item_cost) * ($product->order_item_quantity_ordered);
                                            $total_paid += $unit_paid;
                                        }
                                    ?>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="card-body box-profile">
                                                    <h3 class="profile-username text-center text-success"><?php echo $payment->payment_ref; ?> CONFIRMED</h3>
                                                    <ul class="list-group list-group-unbordered mb-3">
                                                        <li class="list-group-item">
                                                            <b>Mode Of Payment: </b> <a class="float-right"><?php echo $payment->payment_type; ?></a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Date: </b> <a class="float-right"><?php echo date('d M Y g:ia', strtotime($payment->payment_date)); ?></a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Amount Paid: </b> <a class="float-right">Ksh <?php echo number_format($total_paid, 2); ?></a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Payment Ref: </b> <a class="float-right"> <?php echo $payment->payment_ref; ?></a>
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
                                                INNER JOIN farmer_products fp ON fp.farmer_product_id = oi.order_item_farmer_product_id
                                                INNER JOIN products p ON p.product_id  = fp.farmer_product_product_id 
                                                INNER JOIN farmer f ON f.farmer_id = fp.farmer_product_farmer_id
                                                WHERE o.order_id = '{$_GET['order']}'";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($product = $res->fetch_object()) {
                                                    /* Compute Total Payable Amout */
                                                    $unit_paid = ($product->order_item_cost) * ($product->order_item_quantity_ordered);
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