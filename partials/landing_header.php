<header id="top-bar" class="top-bar top-bar--style-2">
    <div class="top-bar__bg" style="background-color: #FFF;background-image: url(img/top_bar_bg-2.png);background-repeat: no-repeat;background-position: center bottom;"></div>

    <div class="container position-relative">
        <div class="row justify-content-between no-gutters">

            <a class="top-bar__logo site-logo" href="../">
                <img class="img-fluid" src="../public/images/logo.png" alt="demo" />
            </a>

            <a id="top-bar__navigation-toggler" class="top-bar__navigation-toggler top-bar__navigation-toggler--dark" href="javascript:void(0);"><span></span></a>

            <div id="top-bar__inner" class="top-bar__inner  text-lg-right">
                <div>
                    <div class="d-lg-flex flex-lg-column-reverse align-items-lg-end">
                        <nav id="top-bar__navigation" class="top-bar__navigation navigation" role="navigation">
                            <ul>
                                <li>
                                    <a href="../">Home</a>
                                </li>

                                <li class="has-submenu">
                                    <a href="javascript:void(0);">Categories</a>
                                    <ul class="submenu">
                                        <?php
                                        $ret = "SELECT * FROM categories 
                                        ORDER BY category_name ASC";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($category = $res->fetch_object()) {
                                        ?>
                                            <li><a href="landing_category?view=<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <li>
                                    <a href="landing_products">Products</a>
                                </li>
                                <li class="li-btn">
                                    <a class="custom-btn custom-btn--small custom-btn--style-2" href="login">Sign In</a>
                                </li>
                            </ul>
                        </nav>
                        <div class="top-bar__contacts">
                            <span>523 Sylvan Ave, 5th Floor Mountain View, Nairobi, Kenya</span>
                            <span><a href="#">+1 (234) 56789</a>,&nbsp;&nbsp;<a href="#"> +254 727 200037
                                </a></span>
                            <span><a href="mailto:support@onlinefarmersstore.com">support@onlinefarmersstore.com</a></span>

                            <div class="social-btns">
                                <a class="fontello-twitter" href="#"></a>
                                <a class="fontello-facebook" href="#"></a>
                                <a class="fontello-linkedin-squared" href="#"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>