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


        <?php require_once('../partials/landing_footer.php'); ?>
    </div>

    <?php require_once('../partials/landing_js.php'); ?>
</body>

</html>