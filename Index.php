<?php 
session_start();
require_once('User.Controller.php');
require_once('Order.Controller.php');
require_once('Upload.Controller.php');
require_once('Products.controller.php');
require_once('Cart.Controller.php');
require_once('triggers.php');
require_once('buildHTML.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/banan/css/styles.css" media="screen" />
    <title>Main Page</title>
</head>
<body>
<header>
<?php require_once('header.php');?>
</header>

    <a href="./">HOME</a>
    <a href="./products">Products</a>
    <a href="./orders">Orders</a>
    <a href="./cart">Cart</a>
    <br>
<?php require_once('router.php');?>
</body>
</html>
