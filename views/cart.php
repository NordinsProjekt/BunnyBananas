<?php require_once('Cart.Controller.php');

echo var_dump($_POST).'<br><br>';



if (isset($_POST['AddToCart'])) {
    $cart = new CartController();

    $cart->AddToCart($_POST['productID'],$_POST['amount']);
}

if (isset($_SESSION['ShoppingCart'])) {
    echo '<pre>', print_r($_SESSION['ShoppingCart']),'</pre>'.'<br><br>';
}
?>


<form action="" method="POST">
<input type="text" Name="productID">ProductID<br>
<input type="text" Name="amount">Amount<br>
<input type="submit" Name="AddToCart" Value="AddToCart">
</form>