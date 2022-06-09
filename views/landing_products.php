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

<body class="woocommerce-page catalog-page">
    <div id="app">
        <!-- start header -->
        <?php require_once('../partials/landing_header.php'); ?>
        <!-- end header -->

        <!-- start hero -->
        <div id="hero" class="jarallax" data-speed="0.7" data-img-position="50% 80%" style="background-image: url(../public/images/landing/15.jpg);color: #333;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-7">
                        <h1 class="__title"><span>Online Farmers Marketplace </span> Products Catalog</h1>

                        <p>

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
                <div class="decor-el decor-el--1" data-jarallax-element="-70" data-speed="0.2">
                    <img class="lazy" width="286" height="280" src="img/blank.gif" data-src="img/decor-el_1.jpg" alt="demo" />
                </div>

                <div class="decor-el decor-el--2" data-jarallax-element="-70" data-speed="0.2">
                    <img class="lazy" width="99" height="88" src="img/blank.gif" data-src="img/decor-el_2.jpg" alt="demo" />
                </div>

                <div class="decor-el decor-el--3" data-jarallax-element="-70" data-speed="0.2">
                    <img class="lazy" width="115" height="117" src="img/blank.gif" data-src="img/decor-el_3.jpg" alt="demo" />
                </div>

                <div class="decor-el decor-el--4" data-jarallax-element="-70" data-speed="0.2">
                    <img class="lazy" width="84" height="76" src="img/blank.gif" data-src="img/decor-el_4.jpg" alt="demo" />
                </div>

                <div class="decor-el decor-el--5" data-jarallax-element="-70" data-speed="0.2">
                    <img class="lazy" width="248" height="309" src="img/blank.gif" data-src="img/decor-el_5.jpg" alt="demo" />
                </div>

                <div class="container">

                    <!-- start goods catalog -->
                    <div class="goods-catalog">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="goods goods--style-1">
                                    <div class="__inner">
                                        <div class="row">
                                            <!-- start item -->
                                            <?php
                                            $ret = "SELECT * FROM farmer_products fp 
                                            INNER JOIN products p ON p.product_id  = fp.farmer_product_product_id 
                                            INNER JOIN categories c ON c.category_id = p.product_category_id
                                            INNER JOIN farmer f ON f.farmer_id = fp.farmer_product_farmer_id";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($product = $res->fetch_object()) {
                                            ?>
                                                <div class="col-12 col-sm-6 col-lg-4">
                                                    <div class="__item">
                                                        <figure class="__image">
                                                            <img style="width: 100%;" src="../public/images/products/<?php echo $product->farmer_product_image; ?>" />
                                                        </figure>

                                                        <div class="__content">
                                                            <h4 class="h6 __title"><a href="landing_product?view=<?php echo $product->farmer_product_id; ?>"><?php echo $product->product_name; ?></a></h4>

                                                            <div class="__category"><a href="#"><?php echo $product->category_name; ?></a></div>

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
                    <!-- end goods catalog -->

                </div>
            </section>
            <!-- end section -->

            <!-- start section -->
            <section class="section section--no-pt section--no-pb section--gutter">
                <div class="container-fluid px-md-0">
                    <!-- start banner simple -->
                    <div class="simple-banner simple-banner--style-2" data-aos="fade" data-aos-offset="50">
                        <div class="d-none d-lg-block">
                            <img class="img-logo img-fluid  lazy" src="img/blank.gif" data-src="img/site_logo.png" alt="demo" />
                        </div>

                        <div class="row no-gutters">
                            <div class="col-12 col-lg-6">
                                <a href="#"><img class="img-fluid w-100  lazy" src="img/blank.gif" data-src="img/banner_bg_3.jpg" alt="demo" /></a>
                            </div>

                            <div class="col-12 col-lg-6">
                                <a href="#"><img class="img-fluid w-100  lazy" src="img/blank.gif" data-src="img/banner_bg_4.jpg" alt="demo" /></a>
                            </div>
                        </div>
                    </div>
                    <!-- end banner simple -->
                </div>
            </section>
            <!-- end section -->
        </main>
        <!-- end main -->

        <!-- start footer -->
        <?php require_once('../partials/landing_footer.php'); ?>
        <!-- end footer -->
    </div>

    <?php require_once('../partials/landing_js.php'); ?>
</body>

</html>