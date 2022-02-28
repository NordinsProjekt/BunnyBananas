<?php
session_start();
require_once "buildHTML.php";
require_once "triggers.php";
require_once "Products.controller.php";

//TESTINDEX

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/stil.css" media="screen" />
    <title>Adminpanel</title>
</head>
<body>
<h1>Products</h1>

<?php
    $controller = new ProductController();
    //$controller->listAllCategories();
    //$controller->listAllColors();
    $controller->listAllProducts();
?>





<?php

    //$controller = new ProductController();
    
    // $color = "--/*sv-art ((";
    // $controller->insertColor($color);
    
    // $category = "--/*ho-odie/ ((";
    // $controller->insertCategory($category);
    
    //$controller->listAllCategories();
    //$controller->listAllColors();
    //$controller->listAllProducts();
?>
</body>
</html>