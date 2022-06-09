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
require_once('../partials/landing_head.php');
?>

<body class="woocommerce-page shop-home-page">
    <div id="app">
        <!-- start header -->
        <?php require_once('../partials/landing_header.php'); ?>
        <!-- end header -->

        <!-- start start screen -->
        <div id="start-screen" class="start-screen start-screen--style-4 js-slick" data-slick='{
					"autoplay": true,
					"fade": true,
					"speed": 1200,
					"arrows": true,
					"dots": false
				}'>
            <div class="start-screen__slide">
                <div class="start-screen__bg" style="background-image: url(../public/images/landing/img_7.jpg);background-position: top 30% right 30%;"></div>

                <div class="start-screen__content__item align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-10 col-md-9 col-lg-9 col-xl-8">
                                <h2 class="__title"><span>Get the</span> Fresh Food <span>from our</span> Agro Market</h2>

                                <p>
                                    <span class="d-none d-sm-block"><a class="custom-btn custom-btn--big custom-btn--style-1" href="#">Discover</a></span>
                                    <span class="d-block d-sm-none"><a class="custom-btn custom-btn--small custom-btn--style-1" href="#">Discover</a></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="start-screen__slide">
                <div class="start-screen__bg" style="background-image: url(../public/images/landing/img_9.jpg);"></div>

                <div class="start-screen__content__item align-items-center">
                    <div class="container">
                        <div class="row justify-content-center text-center">
                            <div class="col-12 col-md-9 col-lg-8 col-xl-7">
                                <h2 class="__title text-white"><span>Fresh</span> Blueberries & Citrus <span>from Agro</span></h2>

                                <p class="text-white">
                                    Bitterling duckbilled barracudina New Zealand sand diver, "oldwife sarcastic fringehead sea toad bighead carp sculpin tadpole fish creek chub." Dottyback sand goby
                                </p>

                                <p class="mt-5 mt-md-8">
                                    <span class="d-none d-sm-block"><a class="custom-btn custom-btn--big custom-btn--style-3" href="#">Discover</a></span>
                                    <span class="d-block d-sm-none"><a class="custom-btn custom-btn--small custom-btn--style-3" href="#">Discover</a></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end start screen -->
       

        <!-- start footer -->
        <footer id="footer" class="footer footer--style-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                        <div class="footer__item">
                            <a class="site-logo" href="index.html">
                                <img class="img-fluid  lazy" src="img/blank.gif" data-src="img/site_logo.png" alt="demo" />
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-md-9 col-lg-6">
                        <div class="footer__item">
                            <nav id="footer__navigation" class="navigation">
                                <div class="row">
                                    <div class="col-6 col-sm-4">
                                        <h5 class="footer__item__title h6">Menu</h5>

                                        <ul>
                                            <li class="active"><a href="index.html">Home</a></li>
                                            <li><a href="#">About</a></li>
                                            <li><a href="#">Pages</a></li>
                                            <li><a href="#">Gallery</a></li>
                                            <li><a href="#">Blog</a></li>
                                            <li><a href="#">Contacts</a></li>
                                        </ul>
                                    </div>

                                    <div class="col-6 col-sm-4">
                                        <h5 class="footer__item__title h6">Shop</h5>

                                        <ul>
                                            <li><a href="#">Partners</a></li>
                                            <li><a href="#">Customer Service</a></li>
                                            <li><a href="#">Vegetables</a></li>
                                            <li><a href="#">Fruits</a></li>
                                            <li><a href="#">Organic Food</a></li>
                                            <li><a href="#">Privacy policy</a></li>
                                        </ul>
                                    </div>

                                    <div class="col-6 col-sm-4">
                                        <h5 class="footer__item__title h6">Information</h5>

                                        <ul>
                                            <li><a href="#">Delivery</a></li>
                                            <li><a href="#">Legal Notice</a></li>
                                            <li><a href="#">About Us</a></li>
                                            <li><a href="#">Secure Payment</a></li>
                                            <li><a href="#">Prices Drop</a></li>
                                            <li><a href="#">Documents</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>

                    <div class="col-12 col-md col-lg-4">
                        <div class="footer__item">
                            <h5 class="footer__item__title h6">Contacts</h5>

                            <address>
                                <p>
                                    523 Sylvan Ave, 5th Floor Mountain View, CA 940 USA
                                </p>

                                <p>
                                    +1 (234) 56789, +1 987 654 3210
                                </p>

                                <p>
                                    <a href="mailto:support@agrocompany.com">support@agrocompany.com</a>
                                </p>
                            </address>

                            <div class="social-btns">
                                <a href="#"><i class="fontello-twitter"></i></a>
                                <a href="#"><i class="fontello-facebook"></i></a>
                                <a href="#"><i class="fontello-linkedin-squared"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-lg-end justify-content-lg-between copyright">
                    <div class="col-12 col-lg-6">
                        <div class="footer__item">
                            <span class="__copy">© 2019, AgroTheme by <a class="__dev" href="../../../themeforest.net/user/artureanec.html" target="_blank">Artureanec</a> | <a href="#">Privacy Policy</a> | <a href="#">Sitemap</a></span>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="footer__item">
                            <form class="form--horizontal no-gutters" action="#">
                                <div class="col-sm-6">
                                    <div class="input-wrp">
                                        <input class="textfield" name="s" type="text" placeholder="Your E-mail" />
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <button class="custom-btn custom-btn--medium custom-btn--style-3 wide" type="submit" role="button">subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->
    </div>

    <?php require_once('../partials/landing_js.php'); ?>
</body>

</html>