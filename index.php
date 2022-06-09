<?php
/*
 * Created on Sat Jun 04 2022
 *
 * MartDevelopers - martmbithi.github.io 
 *
 * martdevelopers254@gmail.com
 *
 * From our local development environment to our deployment, production and live servers, 
 * at full throttle with no loss of data, fluctuations, signal interference or doubt it , 
 * can only be MART DEVELOPERS INC 
 *
 */

/* Register Your Application Logic Here */

if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];
/* Redirect To Index Under Views */
header('Location: ' . $uri . '/FMP/views/');
exit;
