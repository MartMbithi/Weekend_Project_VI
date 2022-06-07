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
/* Add Items */
$db_handle = new DBController();
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM products p INNER JOIN farmer_products fp 
                ON fp.farmer_product_product_id = p.product_id WHERE p.product_name ='" . $_GET["product_name"] . "'");
                $itemArray = array($productByCode[0]["product_name"] => array('product_name' => $productByCode[0]["product_name"],  'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["farmer_product_price"], 'image' => $productByCode[0]["farmer_product_image"]));

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($productByCode[0]["product_name"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($productByCode[0]["product_name"] == $k) {
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
                    if ($_GET["product_name"] == $k)
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
require_once('../partials/head.php');

?>
<link href="../public/css/cart.css" type="text/css" rel="stylesheet" />

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
                            <h1>Add Products To Order Number <?php echo $_GET['ref']; ?> Cart</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="admin_home">Home</a></li>
                                <li class="breadcrumb-item"><a href="admin_home">Orders</a></li>
                                <li class="breadcrumb-item"><a href="admin_orders">Manage Orders</a></li>
                                <li class="breadcrumb-item active">Add</li>
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
                                    <h3 class="text-center">
                                        Products
                                    </h3>
                                </div><!-- /.card-header -->

                                <!-- /.nav-tabs-custom -->
                                <div class="card-body">
                                    <div class="row">
                                        <?php
                                        $product_array = $db_handle->runQuery("SELECT * FROM products p INNER JOIN farmer_products fp 
                                        ON fp.farmer_product_product_id = p.product_id ORDER BY p.product_name ASC");
                                        if (!empty($product_array)) {
                                            foreach ($product_array as $key => $value) {
                                        ?>
                                                <div class="col-sm-3">
                                                    <form method="post" action="admin_add_order_products?ref=<?php echo $_GET['ref']; ?>&action=add&product_name=<?php echo $product_array[$key]["product_name"]; ?>">
                                                        <div class="card">
                                                            <img src="../public/images/products/<?php echo $product_array[$key]["farmer_product_image"]; ?>" class="card-img-top" style="width:100%; height:10vw; object-fit: cover;">
                                                            <div class="card-body">
                                                                <h6>
                                                                    <?php echo $product_array[$key]["product_name"]; ?> <br>
                                                                    <?php echo "Ksh" . number_format($product_array[$key]["farmer_product_price"], 2); ?>
                                                                </h6>
                                                            </div>
                                                            <div class="card-footer">
                                                                <input type="text" class="product-quantity" name="quantity" value="1" size="2" />
                                                                <input type="submit" value="Add to Cart" class="btnAddAction" />
                                                            </div>
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
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if (isset($_SESSION["cart_item"])) {
                                $total_quantity = 0;
                                $total_price = 0;
                            ?>
                                <div class="card card-primary card-outline">
                                    <div class="card-header p-2">
                                        <h3 class="text-right">
                                            <a href="admin_add_order_products?ref=<?php echo $_GET['ref']; ?>&action=empty" class="btn btn-danger"> Clear Cart</a>
                                        </h3>
                                    </div><!-- /.card-header -->

                                    <!-- /.nav-tabs-custom -->
                                    <div class="card-body">

                                        <table class="tbl-cart" cellpadding="10" cellspacing="1">
                                            <tbody>
                                                <tr>
                                                    <th style="text-align:left;">Name</th>
                                                    <th style="text-align:left;">Code</th>
                                                    <th style="text-align:right;" width="5%">Quantity</th>
                                                    <th style="text-align:right;" width="10%">Unit Price</th>
                                                    <th style="text-align:right;" width="10%">Price</th>
                                                    <th style="text-align:center;" width="5%">Remove</th>
                                                </tr>
                                                <?php
                                                foreach ($_SESSION["cart_item"] as $item) {
                                                    $item_price = $item["quantity"] * $item["price"];
                                                ?>
                                                    <tr>
                                                        <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
                                                        <td><?php echo $item["code"]; ?></td>
                                                        <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                                                        <td style="text-align:right;"><?php echo "Ksh " . $item["price"]; ?></td>
                                                        <td style="text-align:right;"><?php echo "Ksh " . number_format($item_price, 2); ?></td>
                                                        <td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                                                    </tr>
                                                <?php
                                                    $total_quantity += $item["quantity"];
                                                    $total_price += ($item["price"] * $item["quantity"]);
                                                }
                                                ?>

                                                <tr>
                                                    <td colspan="2" align="right">Total:</td>
                                                    <td align="right"><?php echo $total_quantity; ?></td>
                                                    <td align="right" colspan="2"><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
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