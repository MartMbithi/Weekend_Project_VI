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
        header("Location: admin_add_order_products?ref=$order_ref");
        exit;
    } else {
        $err = "Failed!, Please Try Again";
    }
}
/* Delete Order */
require_once('../partials/head.php');
?>

<body class="hold-transition sidebar-mini">
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
                            <h1>Orders</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="admin_home">Home</a></li>
                                <li class="breadcrumb-item"><a href="admin_home">Customer Orders</a></li>
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
                                <div class="card-header p-2">
                                    <h3 class="text-right">
                                        <button type="button" data-toggle="modal" data-target="#add_modal" class="btn btn-success"> Register New Customer Order</button>
                                    </h3>
                                </div><!-- /.card-header -->
                                <div class="modal fade" id="add_modal">
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
                                                        <div class="form-group col-md-12">
                                                            <label>Customer Name</label>
                                                            <select type="text" name="order_customer_id" required class="form-control">
                                                                <option>Select Customer Name</option>
                                                                <?php
                                                                $ret = "SELECT * FROM customer ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($customers = $res->fetch_object()) {
                                                                ?>
                                                                    <option value="<?php echo $customers->customer_id; ?>"><?php echo $customers->customer_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="text-right">
                                                        <button name="add_order" class="btn btn-primary" type="submit">
                                                            Register Customer Order
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered text-truncate" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Order REF</th>
                                                <th>Product Details</th>
                                                <th>Customer Details</th>
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
                                            INNER JOIN customer c ON c.customer_id = o.order_customer_id";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($orders = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $orders->order_ref; ?></td>
                                                    <td><?php echo $orders->product_name; ?></td>
                                                    <td>
                                                        Name: <?php echo $orders->customer_name; ?> <br>
                                                        Email: <?php echo $orders->customer_email; ?>
                                                    </td>
                                                    <td><?php echo $orders->order_item_quantity_ordered; ?></td>
                                                    <td>Ksh <?php echo number_format(($orders->order_item_quantity_ordered * $orders->farmer_product_price), 2); ?></td>
                                                    <td><?php echo $orders->order_status; ?></td>
                                                </tr>
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
        <!-- /.content-wrapper -->
        <?php require_once('../partials/footer.php'); ?>

    </div>
    <!-- ./wrapper -->

    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>