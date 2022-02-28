<?php 
session_start();
require_once('triggers.php');
?>
<html>
<head>
    <link rel="stylesheet" media="all" href="/banan/css/styles.css" />
</head>
<body>
<header>
<?php require_once('header.php');?>
</header>

<h1>WEBSHOP!</h1>
    <a href="./">HOME</a>
    <a href="./products">Products</a>
    <a href="./orders">Orders</a>
    <a href="./cart">Cart</a>
    <br>
<?php require_once('router.php');?>

</body>

</html>
