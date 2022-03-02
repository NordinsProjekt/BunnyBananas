<?php 

$userController = new UserController();
$productController = new ProductController();

$searchedProducts = $productController->listSearchedProducts();

?>


<main class="main">
<?php if (!empty($searchedProducts)) {?>
    <?php foreach ($searchedProducts as $product) { ?>

        <?php echo ProductCard($product['ID'],$product['Name'],$product['Category'],$product['Color'],$product['Price'],$product['Balance']); ?>
    
    <?php } //END FOREACH?>
<?php } else { ?>
    <br>
    <p>Din sökning gav inget resultat... försök gärna igen :)</p>    
<?php } //END IF?>
</main>