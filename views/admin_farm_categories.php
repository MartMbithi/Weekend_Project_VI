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
/* Add Category */
if (isset($_POST['add_category'])) {
    $category_name = mysqli_real_escape_string($mysqli, $_POST['category_name']);
    $category_desc = mysqli_real_escape_string($mysqli, $_POST['category_desc']);

    /* Persist */
    $sql = "INSERT INTO categories (category_name, category_desc) VALUES('{$category_name}', '{$category_desc}')";
    $preare = $mysqli->prepare($sql);
    $preare->execute();
    if ($preare) {
        $success = "$category_name Added Successfully";
    } else {
        $err = "Failed!, Please Try Again";
    }
}
/* Update Category */
/* Delete Category */
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
                            <h1>Farmers</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="admin_home">Home</a></li>
                                <li class="breadcrumb-item"><a href="admin_home">Users</a></li>
                                <li class="breadcrumb-item active">Farmers</li>
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
                                        <button type="button" data-toggle="modal" data-target="#add_modal" class="btn btn-success"> Register New Farmer</button>
                                    </h3>
                                </div><!-- /.card-header -->
                                <!-- Add Farmer Modal -->
                                <div class="modal fade" id="add_modal">
                                    <div class="modal-dialog modal-dialog-centered  modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Register New Farmer Account - Fill All Required Fields </h4>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Full Name</label>
                                                            <input type="text" name="farmer_name" required class="form-control">
                                                            <input type="hidden" value="Farmer" name="login_rank" required class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Email</label>
                                                            <input type="email" name="farmer_email" required class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Phone Number</label>
                                                            <input type="text" name="farmer_phone" required class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Login Password</label>
                                                            <input type="password" name="login_password" required class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Address</label>
                                                            <textarea type="text" name="farmer_address" rows="2" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="text-right">
                                                        <button name="register_farmer" class="btn btn-primary" type="submit">
                                                            Register Farmer Account
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
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Contacts</th>
                                                <th>Address</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ret = "SELECT * FROM farmer";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($farmer = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $farmer->farmer_name; ?></td>
                                                    <td><?php echo $farmer->farmer_email; ?></td>
                                                    <td><?php echo $farmer->farmer_phone; ?></td>
                                                    <td><?php echo $farmer->farmer_address; ?></td>
                                                    <td>
                                                        <a data-toggle="modal" href="#update_<?php echo $farmer->farmer_id; ?>" class="badge  badge-pill badge-warning"><em class="fas fa-user-edit"></em> Edit</a>
                                                        <a data-toggle="modal" href="#delete_<?php echo $farmer->farmer_id; ?>" class="badge  badge-pill badge-danger"><em class="fas fa-trash"></em> Delete</a>

                                                    </td>

                                                </tr>
                                                <!-- Manage Farmer Modals -->
                                                <div class="modal fade" id="update_<?php echo $farmer->farmer_id; ?>">
                                                    <div class="modal-dialog modal-dialog-centered  modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Update Farmer Account - Fill All Required Fields </h4>
                                                                <button type="button" class="close" data-dismiss="modal">
                                                                    <span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" enctype="multipart/form-data">
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-12">
                                                                            <label>Full Name</label>
                                                                            <input type="text" name="farmer_name" value="<?php echo $farmer->farmer_name; ?>" required class="form-control">
                                                                            <input type="hidden" value="<?php echo $farmer->farmer_id; ?>" name="farmer_id" required class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label>Email</label>
                                                                            <input type="email" name="farmer_email" value="<?php echo $farmer->farmer_email; ?>" required class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label>Phone Number</label>
                                                                            <input type="text" name="farmer_phone" value="<?php echo $farmer->farmer_phone; ?>" required class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-12">
                                                                            <label>Address</label>
                                                                            <textarea type="text" name="farmer_address" rows="2" class="form-control"><?php echo $farmer->farmer_address; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="text-right">
                                                                        <button name="update_farmer" class="btn btn-primary" type="submit">
                                                                            Update Farmer Account
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete_<?php echo $farmer->farmer_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        Delete <?php echo  $farmer->farmer_name; ?> Account?
                                                                    </h4>
                                                                    <br>
                                                                    <!-- Hide This -->
                                                                    <input type="hidden" name="farmer_login_id" value="<?php echo $farmer->farmer_login_id; ?>">
                                                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                    <button type="submit" class="text-center btn btn-danger" name="delete_farmer">Delete</button>
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