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
include('../partials/landing_head.php');
?>

<body class="woocommerce-page product-page">
    <div id="app">
        <!-- start header -->
        <?php require_once('../partials/landing_header.php');
        $view = $_GET['view'];
        $ret = "SELECT * FROM farmer_products fp 
        INNER JOIN products p ON p.product_id  = fp.farmer_product_product_id 
        INNER JOIN categories c ON c.category_id = p.product_category_id
        INNER JOIN farmer f ON f.farmer_id = fp.farmer_product_farmer_id
        AND fp.farmer_product_id = '{$view}'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($product = $res->fetch_object()) {
        ?>
            <!-- end header -->

            <!-- start hero -->
            <div id="hero" class="jarallax" data-speed="0.7" data-img-position="50% 80%" style="background-image: url(../public/images/landing/15.jpg);color: #333;">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-7">
                            <h1 class="__title"><span>Online Farmers Marketplace</span> <?php echo $product->product_name; ?></h1>
                        </div>
                        <p></p>
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
                                <!-- start product single -->
                                <div class="product-single">
                                    <div class="row">
                                        <div class="col-12 col-lg-5">
                                            <div class="__product-img">
                                                <img style="width: 100%;" src="../public/images/products/<?php echo $product->farmer_product_image; ?>" />
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-7">
                                            <div class="content-container">
                                                <h3 class="__name"><?php echo $product->product_name; ?></h3>
                                                <br>
                                                <div class="__categories">
                                                    Category:
                                                    <span><?php echo $product->category_name; ?></span>
                                                </div>
                                                <br>
                                                <div class="__categories">
                                                    Farmer:
                                                    <span><?php echo $product->farmer_name; ?></span>
                                                </div>

                                                <div class="product-price">
                                                    <span class="product-price__item product-price__item--new">Ksh <?php echo number_format($product->farmer_product_price, 2); ?></span>
                                                </div>

                                                <div class="rating">
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                </div>
                                                <p>
                                                    <?php echo $product->product_desc; ?>
                                                </p>
                                                <form class="__add-to-cart" action="login">
                                                    <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit" role="button"><i class="fontello-shopping-bag"></i>Add to Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- start product single -->
                                <div class="spacer py-3">
                                    <hr>
                                </div>

                                <h2>Related <span>Products</span></h2>
                                <div class="spacer py-2"></div>


                                <!-- start goods -->
                                <div class="goods goods--style-1">
                                    <div class="__inner">
                                        <div class="row">
                                            <?php
                                            $cat = $_GET['cat'];
                                            $return = "SELECT * FROM farmer_products fp 
                                            INNER JOIN products p ON p.product_id  = fp.farmer_product_product_id 
                                            INNER JOIN categories c ON c.category_id = p.product_category_id
                                            INNER JOIN farmer f ON f.farmer_id = fp.farmer_product_farmer_id
                                            AND c.category_id = '{$cat}' AND fp.farmer_product_id != '{$view}'";
                                            $ret_stmt = $mysqli->prepare($return);
                                            $ret_stmt->execute(); //ok
                                            $result = $ret_stmt->get_result();
                                            while ($related_product = $result->fetch_object()) {

                                            ?>
                                                <!-- start item -->
                                                <div class="col-12 col-sm-6 col-lg-4">
                                                    <div class="__item">
                                                        <figure class="__image">
                                                            <img style="width: 100%;" src="../public/images/products/<?php echo $related_product->farmer_product_image; ?>" />
                                                        </figure>

                                                        <div class="__content">
                                                            <h4 class="h6 __title"><a href="#"><?php echo $related_product->product_name; ?></a></h4>

                                                            <div class="__category"><a href="#"><?php echo $related_product->category_name; ?></a></div>
                                                            <div class="__category"><a href="#">Farmer: <?php echo $related_product->farmer_name; ?></a></div>
                                                            <div class="product-price">
                                                                <span class="product-price__item product-price__item--new"><?php echo number_format($related_product->farmer_product_price, 2); ?></span>
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
                            <div class="col-12 my-6 d-md-none"></div>
                        </div>
                    </div>
                </section>
                <!-- end section -->

            </main>
            <!-- end main -->
        <?php } ?>
        <!-- start footer -->
        <?php require_once('../partials/landing_footer.php'); ?>
        <!-- end footer -->
    </div>

    <?php require_once('../partials/landing_js.php'); ?>
</body>


</html>