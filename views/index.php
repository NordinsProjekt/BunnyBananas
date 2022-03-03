<?php 

$userController = new UserController();
$productController = new ProductController();

?>


<main class="main">
<?php foreach ($productController->listProducts(0) as $product) { ?>

    <?php echo ProductCard($product['ID'],$product['Name'],$product['Category'],$product['Color'],$product['Price'],$product['Balance']); ?>
    
<?php }?>

</main>