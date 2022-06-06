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


/* Admin Analytics */

/* Customers */
$query = "SELECT COUNT(*)  FROM `customer`";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($customers);
$stmt->fetch();
$stmt->close();


/* Farmers */
$query = "SELECT COUNT(*)  FROM `farmer`";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($farmers);
$stmt->fetch();
$stmt->close();

/* Farm Product Categories */
$query = "SELECT COUNT(*)  FROM `categories`";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($categories);
$stmt->fetch();
$stmt->close();

/* Farm Products */
$query = "SELECT COUNT(*)  FROM `farmer_products`";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($farmer_products);
$stmt->fetch();
$stmt->close();

/* Unpaid Orders */
$query = "SELECT COUNT(*)  FROM `order` WHERE order_status = 'Pending'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($pending);
$stmt->fetch();
$stmt->close();

/* Paid Orders */
$query = "SELECT COUNT(*)  FROM `order` WHERE order_status = 'Paid'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($paid);
$stmt->fetch();
$stmt->close();

/* Total Orders */
$query = "SELECT COUNT(*)  FROM `order` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($orders);
$stmt->fetch();
$stmt->close();


/* Overall Income */
$query = "SELECT SUM(order_item_cost)  FROM `order_items`";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($payments);
$stmt->fetch();
$stmt->close();
