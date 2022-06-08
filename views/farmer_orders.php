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
require_once('../config/codeGen.php');
check_login();
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

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php require_once('../partials/navbar.php'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require_once('../partials/aside.php');
        $login_id = $_SESSION['login_id'];
        $farmer_sql = "SELECT * FROM farmer WHERE farmer_login_id = '{$login_id}'";
        $farmer_stmt = $mysqli->prepare($farmer_sql);
        $farmer_stmt->execute(); //ok
        $farmer_results = $farmer_stmt->get_result();
        while ($farmer_details = $farmer_results->fetch_object()) {
            /* Farmer ID */
            $farmer_id = $farmer_details->farmer_id; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Orders</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="farmer_home">Home</a></li>
                                    <li class="breadcrumb-item active">Manage Orders</li>
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
                                    <div class="card-body">
                                        <table class="table table-bordered text-truncate" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Order REF</th>
                                                    <th>Customer</th>
                                                    <th>Products Qty</th>
                                                    <th>Order Status</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $ret = "SELECT * FROM `order` o 
                                                INNER JOIN customer c ON c.customer_id = o.order_customer_id
                                                INNER JOIN order_items oi ON o.order_id = oi.order_item_order_id 
                                                INNER JOIN farmer_products fp ON fp.farmer_product_id = oi.order_item_farmer_product_id 
                                                WHERE fp.farmer_product_farmer_id = '{$farmer_id}'";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($orders = $res->fetch_object()) {
                                                    /* Count Number Of Products Ordered */
                                                    $query = "SELECT SUM(order_item_quantity_ordered)  FROM order_items
                                                    WHERE order_item_order_id = '{$orders->order_id}'";
                                                    $stmt = $mysqli->prepare($query);
                                                    $stmt->execute();
                                                    $stmt->bind_result($order_items);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                                    if ($order_items <= 0) {
                                                        $order_items = '0';
                                                    } else {
                                                        $order_items = $order_items;
                                                    }
                                                ?>
                                                    <tr>
                                                        <td><?php echo $orders->order_ref; ?></td>
                                                        <td>
                                                            <b>Name: </b> <?php echo $orders->customer_name; ?> <br>
                                                            <b>Email: </b> <?php echo $orders->customer_email; ?>
                                                        </td>
                                                        <td><?php echo $order_items; ?></td>
                                                        <td>
                                                            <?php if ($orders->order_status == 'Pending') { ?>
                                                                <span class="badge  badge-pill badge-danger">Pending</span>
                                                            <?php } else { ?>
                                                                <span class="badge  badge-pill badge-success">Paid</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($order_items <= 0) { ?>
                                                                <a href="admin_add_order_products?ref=<?php echo $orders->order_ref; ?>" class="badge  badge-pill badge-success"><em class="fas fa-shopping-cart"></em> Add Products</a>

                                                            <?php }
                                                            if ($orders->order_status == 'Pending') {
                                                            ?>
                                                                <a data-toggle="modal" href="#pay_<?php echo $orders->order_id; ?>" class="badge  badge-pill badge-primary"><em class="fas fa-check"></em> Pay Order</a>
                                                            <?php } ?>
                                                            <a href="admin_view_order?order=<?php echo $orders->order_id; ?>&ref=<?php echo $orders->order_ref; ?>" class="badge  badge-pill badge-warning"><em class="fas fa-eye"></em> View Order</a>
                                                            <a data-toggle="modal" href="#delete_<?php echo $orders->order_id; ?>" class="badge  badge-pill badge-danger"><em class="fas fa-trash"></em> Delete Order</a>
                                                        </td>
                                                    </tr>
                                                    <!-- Modals -->
                                                    <div class="modal fade" id="delete_<?php echo $orders->order_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                                    <button type="button" class="close" data-dismiss="modal">
                                                                        <span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="POST">
                                                                    <div class="modal-body text-center ">
                                                                        <h4 class="text-danger">
                                                                            Delete Order <?php echo  $orders->order_ref; ?>? </h4>
                                                                        <br>
                                                                        <!-- Hide This -->
                                                                        <input type="hidden" name="order_id" value="<?php echo $orders->order_id; ?>">
                                                                        <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                        <button type="submit" class="text-center btn btn-danger" name="delete_order">Delete</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Pay Order -->
                                                    <div class="modal fade" id="pay_<?php echo $orders->order_id; ?>">
                                                        <div class="modal-dialog modal-dialog-centered  modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Fill All Required Fields </h4>
                                                                    <button type="button" class="close" data-dismiss="modal">
                                                                        <span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" enctype="multipart/form-data">
                                                                        <div class="form-row">
                                                                            <div class="form-group col-md-6">
                                                                                <label>Payment Ref</label>
                                                                                <input type="text" readonly name="payment_ref" value="<?php echo $paycode; ?>" required class="form-control">
                                                                                <input type="hidden" name="payment_order_id" value="<?php echo $orders->order_id; ?>" required class="form-control">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label>Payment Means</label>
                                                                                <select type="text" name="payment_type" required class="form-control">
                                                                                    <option>Cash On Delivery</option>
                                                                                    <option>Credit / Debit Card</option>
                                                                                    <option>Mpesa</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <div class="text-right">
                                                                            <button name="pay_order" class="btn btn-primary" type="submit">
                                                                                Pay Order
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Modals -->
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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