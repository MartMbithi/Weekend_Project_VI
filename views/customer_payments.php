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
                                <h1 class="m-0 text-dark"> Payments</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Payments</li>
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
                            <div class="col-md-12">
                                <div class="card card-primary card-outline">
                                    <div class="card-body">
                                        <table class="table table-bordered text-truncate" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Order REF</th>
                                                    <th>Payment REF</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $ret = "SELECT * FROM `order` o
                                                INNER JOIN customer c ON c.customer_id = o.order_customer_id
                                                INNER JOIN payment p ON p.payment_order_id = o.order_id
                                                WHERE o.order_customer_id = '$customer_id'";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($payments = $res->fetch_object()) {
                                                    /* Get Order Payment Amount */
                                                    $sql = "SELECT * FROM order_items oi 
                                                    INNER JOIN `order` o ON o.order_id = oi.order_item_order_id
                                                    INNER JOIN farmer_products fp ON fp.farmer_product_id = oi.order_item_farmer_product_id
                                                    INNER JOIN products p ON p.product_id  = fp.farmer_product_product_id 
                                                    INNER JOIN farmer f ON f.farmer_id = fp.farmer_product_farmer_id
                                                    WHERE o.order_id = '{$payments->order_id}'";
                                                    $stmt = $mysqli->prepare($sql);
                                                    $stmt->execute(); //ok
                                                    $return = $stmt->get_result();
                                                    $total_paid = 0;
                                                    while ($product = $return->fetch_object()) {
                                                        /* Compute Total Payable Amout */
                                                        $unit_paid = ($product->order_item_cost) * ($product->order_item_quantity_ordered);
                                                        $total_paid += $unit_paid;
                                                    }
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $payments->order_ref; ?>
                                                        </td>
                                                        <td><?php echo $payments->payment_ref; ?></td>
                                                        <td>Ksh: <?php echo number_format($total_paid, 2); ?></td>
                                                        <td>
                                                            <?php echo date('d M Y g:ia', strtotime($payments->payment_date)); ?>
                                                        </td>
                                                        <td>
                                                            <a data-toggle="modal" href="#delete_<?php echo $payments->payment_id; ?>" class="badge  badge-pill badge-danger"><em class="fas fa-trash"></em> Delete</a>
                                                        </td>

                                                    </tr>

                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="delete_<?php echo $payments->payment_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                            Delete Payment <?php echo  $payments->payment_ref; ?>? </h4>
                                                                        <br>
                                                                        <!-- Hide This -->
                                                                        <input type="hidden" name="payment_id" value="<?php echo $payments->payment_id; ?>">
                                                                        <input type="hidden" name="order_id" value="<?php echo $payments->order_id; ?>">
                                                                        <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                        <button type="submit" class="text-center btn btn-danger" name="delete_payment">Delete</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.nav-tabs-custom -->
                            </div>
                        </div>
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