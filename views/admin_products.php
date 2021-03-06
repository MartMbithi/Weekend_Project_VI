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
/* Add Products */
if (isset($_POST['add_product'])) {
    $product_name = mysqli_real_escape_string($mysqli, $_POST['product_name']);
    $product_desc = mysqli_real_escape_string($mysqli, $_POST['product_desc']);
    $product_category_id = mysqli_real_escape_string($mysqli, $_POST['product_category_id']);

    /* Persist */
    $sql = "INSERT INTO products(product_name, product_desc, product_category_id) VALUES('{$product_name}', '{$product_desc}', '{$product_category_id}')";
    $prepare = $mysqli->prepare($sql);
    $prepare->execute();
    if ($prepare) {
        $success  = "$product_name Added";
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Update Products */
if (isset($_POST['update_product'])) {
    $product_id = mysqli_real_escape_string($mysqli, $_POST['product_id']);
    $product_name = mysqli_real_escape_string($mysqli, $_POST['product_name']);
    $product_desc = mysqli_real_escape_string($mysqli, $_POST['product_desc']);
    $product_category_id = mysqli_real_escape_string($mysqli, $_POST['product_category_id']);

    /* Persist */
    $sql = "UPDATE products SET product_name = '{$product_name}', product_desc = '{$product_desc}', product_category_id = '{$product_category_id}'
    WHERE product_id = '{$product_id}'";
    $prepare = $mysqli->prepare($sql);
    $prepare->execute();
    if ($prepare) {
        $success = "$product_name Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Delete Products */
if (isset($_POST['delete_product'])) {
    $product_id = mysqli_real_escape_string($mysqli, $_POST['product_id']);

    /* Persist */
    $sql = "DELETE FROM products WHERE product_id = '{$product_id}'";
    $prepare = $mysqli->prepare($sql);
    $prepare->execute();
    if ($prepare) {
        $success = "Product Deleted";
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
        <?php require_once('../partials/aside.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Products</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="admin_home">Home</a></li>
                                <li class="breadcrumb-item"><a href="admin_home">Farm Products</a></li>
                                <li class="breadcrumb-item active">Products</li>
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
                                        <button type="button" data-toggle="modal" data-target="#add_modal" class="btn btn-success"> Register New Product</button>
                                    </h3>
                                </div><!-- /.card-header -->
                                <!-- Add Category Modal -->
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
                                                        <div class="form-group col-md-6">
                                                            <label>Product Name</label>
                                                            <input type="text" name="product_name" required class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Category Name</label>
                                                            <select type="text" name="product_category_id" required class="form-control">
                                                                <option>Select Category</option>
                                                                <?php
                                                                $ret = "SELECT * FROM categories";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($category = $res->fetch_object()) {
                                                                ?>
                                                                    <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Product Details</label>
                                                            <textarea type="text" name="product_desc" rows="2" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="text-right">
                                                        <button name="add_product" class="btn btn-primary" type="submit">
                                                            Register Product
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
                                                <th>Product Name</th>
                                                <th>Category Name</th>
                                                <th>Product Details</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ret = "SELECT * FROM products p 
                                            INNER JOIN categories c ON c.category_id  = p.product_category_id";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($product = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $product->product_name; ?></td>
                                                    <td><?php echo $product->category_name; ?></td>
                                                    <td><?php echo $product->product_desc; ?></td>
                                                    <td>
                                                        <a data-toggle="modal" href="#update_<?php echo $product->product_id; ?>" class="badge  badge-pill badge-warning"><em class="fas fa-edit"></em> Edit</a>
                                                        <a data-toggle="modal" href="#delete_<?php echo $product->product_id; ?>" class="badge  badge-pill badge-danger"><em class="fas fa-trash"></em> Delete</a>
                                                    </td>

                                                </tr>
                                                <!-- Manage Category Modals -->
                                                <div class="modal fade" id="update_<?php echo $product->product_id; ?>">
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
                                                                            <label>Product Name</label>
                                                                            <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>" required class="form-control">
                                                                            <input type="text" name="product_name" value="<?php echo $product->product_name; ?>" required class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label>Category Name</label>
                                                                            <select type="text" name="product_category_id" required class="form-control">
                                                                                <option value="<?php echo $product->category_id; ?>"><?php echo $productg->category_name; ?></option>
                                                                                <?php
                                                                                $sql = "SELECT * FROM categories";
                                                                                $stmt_1 = $mysqli->prepare($sql);
                                                                                $stmt_1->execute(); //ok
                                                                                $result = $stmt_1->get_result();
                                                                                while ($category = $result->fetch_object()) {
                                                                                ?>
                                                                                    <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-12">
                                                                            <label>Product Details</label>
                                                                            <textarea type="text" name="product_desc" rows="2" class="form-control"><?php echo $product->product_desc; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="text-right">
                                                                        <button name="update_product" class="btn btn-primary" type="submit">
                                                                            Update Product
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete_<?php echo $product->product_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        Delete <?php echo  $product->product_name; ?>? </h4>
                                                                    <br>
                                                                    <!-- Hide This -->
                                                                    <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
                                                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                    <button type="submit" class="text-center btn btn-danger" name="delete_product">Delete</button>
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