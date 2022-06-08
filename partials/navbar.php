<?php
/*
 * Created on Wed Jun 08 2022
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

if ($_SESSION['login_rank'] == 'Admin') {
?>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" href="admin_profile">
                    <i class="fas fa-user-cog"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout"><i class="fas fa-power-off"></i></a>
            </li>
        </ul>
    </nav>
<?php } else { ?>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" href="farmer_profile">
                    <i class="fas fa-user-cog"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout"><i class="fas fa-power-off"></i></a>
            </li>
        </ul>
    </nav>
<?php } ?>