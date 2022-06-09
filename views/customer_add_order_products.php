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
require_once('../config/dbcontroller.php');
require_once('../config/checklogin.php');
require_once('../config/codeGen.php');
check_login();
/* Add Items */
$db_handle = new DBController();
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM products p INNER JOIN farmer_products fp 
                ON fp.farmer_product_product_id = p.product_id WHERE fp.farmer_product_product_id ='" . $_GET["farmer_product_id"] . "'");
                $itemArray = array(
                    $productByCode[0]["farmer_product_id"] =>
                    array(
                        'farmer_product_id' => $productByCode[0]["farmer_product_id"],
                        'product_name' => $productByCode[0]["product_name"],
                        'quantity' => $_POST["quantity"],
                        'price' => $productByCode[0]["farmer_product_price"],
                    )
                );

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($productByCode[0]["farmer_product_id"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($productByCode[0]["farmer_product_id"] == $k) {
                                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_GET["farmer_product_id"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}
/* Persist Order */
if (isset($_POST['add_customer_order'])) {
    $cart_products = $_SESSION["cart_item"];
    foreach ($cart_products as $cart_products) {
        $order_item_order_id = mysqli_real_escape_string($mysqli, $_POST['order_item_order_id']);
        $order_item_quantity_ordered = mysqli_real_escape_string($mysqli, $cart_products['quantity']);
        $order_item_cost = mysqli_real_escape_string($mysqli, $cart_products['price']);
        $order_item_farmer_product_id = mysqli_real_escape_string($mysqli, $cart_products['farmer_product_id']);
        /* Check If Product Count Is Over Given One */
        $sql = "SELECT * FROM  farmer_products  WHERE farmer_product_id = '{$order_item_farmer_product_id}'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $products = mysqli_fetch_assoc($res);
            /* Check If Current Product Quantity Has Reached Limit  $sale_quantity */
            if ($products['farmer_product_quantity'] >= $order_item_quantity_ordered) {
                /* Deduct Product Sale Quantity From Products Table */
                $new_product_qty = $products['farmer_product_quantity'] - $order_item_quantity_ordered;
                /* Persist */
                $sql = "INSERT order_items (order_item_order_id, order_item_farmer_product_id, order_item_quantity_ordered, order_item_cost)
                VALUES(
                '{$order_item_order_id}',
                '{$order_item_farmer_product_id}',
                '{$order_item_quantity_ordered}',
                '{$order_item_cost}'
                )";
                $product_sql = "UPDATE farmer_products SET farmer_product_quantity = '{$new_product_qty}' WHERE farmer_product_id = '{$order_item_farmer_product_id}'";
                $prepare = $mysqli->prepare($sql);
                $product_prepare = $mysqli->prepare($product_sql);

                $prepare->execute();
                $product_prepare->execute();
            }
        }
    }
    if ($prepare && $product_prepare) {
        unset($_SESSION['cart_item']);/* Clear Cart */
        $_SESSION['success'] = 'Items Added To Order, Proceed To Pay Order';
        header("Location: customer_orders");
        exit;
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
                                <h1 class="text-dark">Add Products To Order Number <?php echo $_GET['ref']; ?> Cart</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="customer_home">Home</a></li>
                                    <li class="breadcrumb-item"><a href="customer_orders">Orders</a></li>
                                    <li class="breadcrumb-item active"><?php echo $_GET['ref']; ?></li>
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
                            <div class="col-md-7">
                                <div class="card card-primary card-outline">
                                    <div class="card-header p-2">
                                        <h3 class="text-center">
                                            Products
                                        </h3>
                                    </div><!-- /.card-header -->

                                    <!-- /.nav-tabs-custom -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <input class="form-control" type="text" id="Product_Search" onkeyup="FilterFunction()" placeholder="Search Products">
                                                <br>
                                            </div>
                                            <?php
                                            $product_array = $db_handle->runQuery("SELECT * FROM products p INNER JOIN farmer_products fp 
                                                ON fp.farmer_product_product_id = p.product_id ORDER BY p.product_name ASC");
                                            if (!empty($product_array)) {
                                                foreach ($product_array as $key => $value) {
                                            ?>
                                                    <div class="col-4 Product_Name">
                                                        <form method="post" action="customer_add_order_products?ref=<?php echo $_GET['ref']; ?>&action=add&farmer_product_id=<?php echo $product_array[$key]["farmer_product_id"]; ?>">
                                                            <div class="card">
                                                                <img src="../public/images/products/<?php echo $product_array[$key]["farmer_product_image"]; ?>" class="card-img-top" style="width:100%; height:10vw; object-fit: cover;">
                                                                <div class="card-body">
                                                                    <h6>
                                                                        <span><?php echo $product_array[$key]["product_name"]; ?></span> <br>
                                                                        <?php echo "Ksh" . number_format($product_array[$key]["farmer_product_price"], 2); ?> <br>
                                                                    </h6>
                                                                </div>
                                                                <?php
                                                                if ($product_array[$key]['farmer_product_quantity'] <= 0) {
                                                                } else {
                                                                ?>
                                                                    <div class="card-footer">
                                                                        <input type="text" class="product-quantity" name="quantity" value="1" size="2" />
                                                                        <input type="submit" value="Add to Cart" class="btnAddAction" />
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </form>
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <?php
                                if (isset($_SESSION["cart_item"])) {
                                    $total_quantity = 0;
                                    $total_price = 0;
                                ?>
                                    <div class="card card-primary card-outline">
                                        <div class="card-header p-2">
                                            <h3 class="text-right">
                                                <a href="customer_add_order_products?ref=<?php echo $_GET['ref']; ?>&action=empty" class="btn btn-danger"> Clear Cart</a>
                                            </h3>
                                        </div><!-- /.card-header -->

                                        <!-- /.nav-tabs-custom -->
                                        <div class="card-body">
                                            <table cellpadding="10" cellspacing="1">
                                                <tbody>
                                                    <tr>
                                                        <th style="text-align:left;">Name</th>
                                                        <th style="text-align:right;" width="20%">Quantity</th>
                                                        <th style="text-align:right;" width="20%">Unit Price</th>
                                                        <th style="text-align:right;" width="20%">Price</th>
                                                        <th style="text-align:right;" width="20%">Action</th>
                                                    </tr>
                                                    <?php
                                                    foreach ($_SESSION["cart_item"] as $item) {
                                                        $item_price = $item["quantity"] * $item["price"];
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $item["product_name"]; ?></td>
                                                            <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                                                            <td style="text-align:right;"><?php echo "Ksh " . $item["price"]; ?></td>
                                                            <td style="text-align:right;"><?php echo "Ksh " . number_format($item_price, 2); ?></td>
                                                            <td style="text-align:right;"><a href="customer_add_order_products?ref=<?php echo $_GET['ref']; ?>&action=remove&farmer_product_id=<?php echo $item["farmer_product_id"]; ?>" class="badge  badge-pill badge-danger"><i class="fas fa-trash"></i> Remove</a></td>
                                                        </tr>
                                                    <?php
                                                        $total_quantity += $item["quantity"];
                                                        $total_price += ($item["price"] * $item["quantity"]);
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td align="left"><b>Total: </b></td>
                                                        <td colspan="1" align="right"><b><?php echo $total_quantity; ?></b></td>
                                                        <td align="right" colspan="2"><strong><?php echo "Ksh " . number_format($total_price, 2); ?></strong></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <hr>
                                            <div class="text-right">
                                                <form method="POST">
                                                    <?php
                                                    /* Get Order ID */
                                                    $ret = "SELECT * FROM `order` WHERE order_ref = '{$_GET['ref']}' ";
                                                    $stmt = $mysqli->prepare($ret);
                                                    $stmt->execute(); //ok
                                                    $res = $stmt->get_result();
                                                    while ($order = $res->fetch_object()) {
                                                    ?>
                                                        <input type="hidden" name="order_item_order_id" value="<?php echo $order->order_id; ?>">
                                                        <button name="add_customer_order" class="btn btn-primary" type="submit">
                                                            Submit Order
                                                        </button>
                                                    <?php } ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else {
                                ?>
                                    <div class="card card-danger card-outline">
                                        <div class="card-header p-2">
                                            <h3 class="text-center text-danger">
                                                Your Cart is Empty
                                            </h3>
                                        </div><!-- /.card-header -->
                                    </div>
                                <?php
                                }
                                ?>
                            </div><!-- /.card-body -->
                        </div><!-- /.container-fluid -->
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
    <?php require_once('../partials/filter_js.php'); ?>
</body>


</html>