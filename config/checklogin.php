<?php
/*
 * Created on Sat Jun 04 2022
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


function check_login()
{
	/* Use User Id As Session */
	if ((strlen($_SESSION['login_id']) == 0)) {
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "index";
		$_SESSION["login_id"] = "";
		header("Location: http://$host$uri/$extra");
	}
}
