<?php $cartController = new CartController(); ?>

<?php foreach ($cartController->listCart() as $product) {?>

<?php echo CartProduct($product['ID'],$product['Name'],$product['Category'],$product['Color'],$product['Price'],$product['Balance']); ?>

<?php }?>

<!-- 
<form action="" method="POST">
<input type="text" Name="productID">ProductID<br>
<input type="text" Name="amount">Amount<br>
<input type="submit" Name="AddToCart" Value="AddToCart">
</form>
 -->
