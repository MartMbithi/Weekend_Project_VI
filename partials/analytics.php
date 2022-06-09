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



if ($_SESSION['login_rank'] == 'Farmer') {
    /* Load Farmer Analytics */
    /* Get Farmer ID */
    $farmer_login_id = $_SESSION['login_id'];
    $ret = "SELECT * FROM farmer WHERE farmer_login_id = '{$farmer_login_id}'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($farmer = $res->fetch_object()) {
        /* Farmer ID */
        $farmer_id = $farmer->farmer_id;
        /* Farm Products */
        $query = "SELECT COUNT(*)  FROM `farmer_products` WHERE  farmer_product_farmer_id = '{$farmer_id}'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($farmer_products);
        $stmt->fetch();
        $stmt->close();

        /* Unpaid Orders */
        $query = "SELECT COUNT(*) FROM `order` o 
        INNER JOIN order_items oi ON o.order_id = oi.order_item_order_id 
        INNER JOIN farmer_products fp ON fp.farmer_product_id = oi.order_item_farmer_product_id 
        WHERE fp.farmer_product_farmer_id = '{$farmer_id}' AND o.order_status = 'Pending'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($pending);
        $stmt->fetch();
        $stmt->close();

        /* Paid Orders */
        $query = "SELECT COUNT(*) FROM `order` o 
        INNER JOIN order_items oi ON o.order_id = oi.order_item_order_id 
        INNER JOIN farmer_products fp ON fp.farmer_product_id = oi.order_item_farmer_product_id 
        WHERE fp.farmer_product_farmer_id = '{$farmer_id}' AND o.order_status = 'Paid'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($paid);
        $stmt->fetch();
        $stmt->close();

        /* Total Orders */
        $query = "SELECT COUNT(*) FROM `order` o 
        INNER JOIN order_items oi ON o.order_id = oi.order_item_order_id 
        INNER JOIN farmer_products fp ON fp.farmer_product_id = oi.order_item_farmer_product_id 
        WHERE fp.farmer_product_farmer_id = '{$farmer_id}'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($orders);
        $stmt->fetch();
        $stmt->close();


        /* Overall Income */
        $ret = "SELECT * FROM order_items oi 
        INNER JOIN `order` o ON o.order_id = oi.order_item_order_id
        INNER JOIN farmer_products fp ON fp.farmer_product_id = oi.order_item_farmer_product_id
        INNER JOIN products p ON p.product_id  = fp.farmer_product_product_id 
        WHERE o.order_status = 'Paid' AND fp.farmer_product_farmer_id = '{$farmer_id}'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        $payments = 0;
        while ($product = $res->fetch_object()) {
            /* Compute Total Payable Amout */
            $unit_paid = ($product->order_item_cost) * ($product->order_item_quantity_ordered);
            $payments += $unit_paid;
        }
    }
} else if ($_SESSION['login_rank'] == 'Customer') {
    /* Load Customer Analytics */
    /* Get Farmer ID */
    $customer = $_SESSION['login_id'];
    $ret = "SELECT * FROM customer WHERE customer_login_id = '{$customer}'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($customer = $res->fetch_object()) {
        /* Farmer ID */
        $customer_id = $customer->customer_id;

        /* Unpaid Orders */
        $query = "SELECT COUNT(*) FROM `order` o
        WHERE o.order_customer_id = '{$customer_id}' AND o.order_status = 'Pending'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($pending);
        $stmt->fetch();
        $stmt->close();

        /* Paid Orders */
        $query = "SELECT COUNT(*) FROM `order` o
        WHERE o.order_customer_id = '{$customer_id}' AND o.order_status = 'Paid'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($paid);
        $stmt->fetch();
        $stmt->close();

        /* Total Orders */
        $query = "SELECT COUNT(*) FROM `order` o 
        WHERE o.order_customer_id = '{$customer_id}'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($orders);
        $stmt->fetch();
        $stmt->close();


        /* Overall Expenditure */
        $ret = "SELECT * FROM order_items oi 
        INNER JOIN `order` o ON o.order_id = oi.order_item_order_id
        INNER JOIN farmer_products fp ON fp.farmer_product_id = oi.order_item_farmer_product_id
        INNER JOIN products p ON p.product_id  = fp.farmer_product_product_id 
        WHERE o.order_status = 'Paid' AND o.order_customer_id = '{$customer_id}'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        $payments = 0;
        while ($product = $res->fetch_object()) {
            /* Compute Total Payable Amout */
            $unit_paid = ($product->order_item_cost) * ($product->order_item_quantity_ordered);
            $payments += $unit_paid;
        }
    }
} else {
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
    $query = "SELECT COUNT(*)  FROM `products`";
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
    $ret = "SELECT * FROM order_items oi 
    INNER JOIN `order` o ON o.order_id = oi.order_item_order_id
    INNER JOIN farmer_products fp ON fp.farmer_product_id = oi.order_item_farmer_product_id
    INNER JOIN products p ON p.product_id  = fp.farmer_product_product_id 
    WHERE o.order_status = 'Paid'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    $payments = 0;
    while ($product = $res->fetch_object()) {
        /* Compute Total Payable Amout */
        $unit_paid = ($product->order_item_cost) * ($product->order_item_quantity_ordered);
        $payments += $unit_paid;
    }
}
