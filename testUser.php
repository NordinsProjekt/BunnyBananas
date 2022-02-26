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

<br><br>
<form action="#" method="get">
  <label for="products">Choose a product:</label>
  <select id="products" name="products">
    <option value="hoodies">Hoodies</option>
    <option value="caps">Caps</option>
    <option value="skateboards">Skateboards</option>
    <option value="t-shirts">T-Shirts</option>
    <option value="wheels">Wheels</option>
  </select>
  <input type="submit" name="search" value="Search">
</form>

<?php

if (isset($_GET['search']))
{
    $product = $_GET['products'];
    
}


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