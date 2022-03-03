<?php 
session_start();
require_once('controller/User.Controller.php');
require_once('controller/Order.Controller.php');
require_once('controller/Upload.Controller.php');
require_once('controller/Products.Controller.php');
require_once('controller/Cart.Controller.php');
require_once('controller/API.Controller.php');
require_once('triggers.php');
require_once('buildHTML.php');

if (!isset($_SESSION['Message']))
{
    $_SESSION['Message'] = "";
}

if (!isset($_SESSION['ExchangeRate']))
{
    $_SESSION['ExchangeRate'] = APIconnection();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/bunnybananas/css/styles.css" media="screen" />
    <script src="/bunnybananas/css/javascript.js"></script>
    <link rel="stylesheet" type="text/css" href="/bunnybananas/css/slider.css">
    <script src="/bunnybananas/css/slider.js"></script>
    <title>Main Page</title>
</head>
<body>

<?php require_once('header.php');?>

<main>

<?php require_once('router.php');?>
</main>
<footer>
    <h2>Adress</h2>
    <p>Skateparken 3</p>
    <p>Sverige</p>
</footer>
</body>
</html>
