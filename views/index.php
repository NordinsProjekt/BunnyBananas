<?php 

$userController = new UserController();
$productController = new ProductController();

?>


<table>
<?php

foreach ($productController->listAllProducts() as $product) { ?>

    <tr>
        <td><?php echo ProductCard($product['ID'],$product['Name'],$product['Category'],$product['Color'],$product['Price'],$product['Balance']); ?></td>
    </tr>

<?php }?>
</table>