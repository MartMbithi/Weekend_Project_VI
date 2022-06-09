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
require_once('../partials/landing_head.php');
?>

<body class="woocommerce-page product-page">
    <div id="app">
        <!-- start header -->
        <?php require_once('../partials/landing_header.php');
        $view = $_GET['view'];
        $ret = "SELECT * FROM categories WHERE category_id = '{$view}'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($category = $res->fetch_object()) {
        ?>
            <!-- end header -->

            <!-- start hero -->
            <div id="hero" class="jarallax" data-speed="0.7" data-img-position="50% 100%" style="background-image: url(../public/images/landing/13.jpg);color: #333;">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-7">
                            <h1 class="__title"><span>Online Farmers Marketplace</span> - <?php echo $category->category_name; ?></h1>
                            <p>
                                <?php
                                echo $category->category_desc; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end hero -->
            <!-- start main -->
            <main role="main">
                <!-- start section -->
                <section class="section">

                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2><?php echo $category->category_name; ?> On Sale</h2>
                                <div class="spacer py-2"></div>
                                <!-- start goods -->
                                <div class="goods goods--style-1">
                                    <div class="__inner">
                                        <div class="row">
                                            <?php
                                            $ret = "SELECT * FROM farmer_products fp 
                                            INNER JOIN products p ON p.product_id  = fp.farmer_product_product_id 
                                            INNER JOIN farmer f ON f.farmer_id = fp.farmer_product_farmer_id
                                            WHERE p.product_category_id = '{$view}'";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($product = $res->fetch_object()) {
                                            ?>
                                                <!-- start item -->
                                                <div class="col-12 col-sm-6 col-lg-4">
                                                    <div class="__item">
                                                        <figure class="__image">
                                                            <img style="width: 100%;" src="../public/images/products/<?php echo $product->farmer_product_image; ?>" />
                                                        </figure>

                                                        <div class="__content">
                                                            <h4 class="h6 __title"><a href="#"><?php echo $product->product_name; ?></a></h4>

                                                            <div class="__category"><a href="#"><?php echo $category->category_name; ?></a></div>

                                                            <div class="product-price">
                                                                <span class="product-price__item product-price__item--new">Ksh <?php echo number_format($product->farmer_product_price, 2); ?></span>
                                                            </div>
                                                            <a class="custom-btn custom-btn--medium custom-btn--style-1" href="login"><i class="fontello-shopping-bag"></i>Login To Order</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end item -->
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- end goods -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- end section -->

            </main>
            <!-- end main -->

            <!-- start footer -->
            <?php require_once('../partials/landing_footer.php'); ?>
            <!-- end footer -->
        <?php } ?>
    </div>

    <?php require_once('../partials/landing_footer.php'); ?>
</body>

</html>