<?php
require_once "User.Controller.php";

if (key_exists('addUser',$_POST) && key_exists('txtUsername',$_POST) && 
key_exists('txtPassword',$_POST) && key_exists('txtEmail',$_POST) && key_exists('selGroups',$_POST))
{
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
    $email = $_POST['txtEmail'];
    $groupId = (int)$_POST['selGroups'];
    $reklam = false;
    if ($username == "" or $password == "" or $email == "")
    {
        echo "Fyll i alla fält tack";
        exit();
    }
    $controller = new UserController();
    $controller->AddNewUser($username,$password,$email,$groupId,$reklam);
}

if (key_exists('login',$_POST))
{
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
    if ($username == "" or $password == "")
    {
        echo "Fyll i alla fält tack";
        header("Location: ./");
        exit();
    }
    $controller = new UserController();
    $controller->VerifyUser($username,$password);
    header("Refresh: 0");
    exit();
}

if (key_exists('logout',$_POST))
{
    session_unset();
    session_destroy();
    header("Location: ./");
    exit();
}

if (key_exists('saveProfile',$_POST))
{
    //Dessa är frivillga fält i profilen.
    //Ingen kontroll om de är tomma.
    $controller = new UserController();
    $controller->SaveShippingAddress($_POST['txtFirstname'],$_POST['txtLastname'],
    $_POST['txtAddress'],$_POST['txtAddress2'], $_POST['txtPostalcode'],
    $_POST['txtPostalarea'],$_POST['txtCountry']);
    if (key_exists('reklam',$_POST))
    {
        $controller->AddToReklam($_SESSION['userId']);
    }
    else
    {
        $controller->RemoveReklam($_SESSION['userId']);
    }
    //header("Location: ./profile");
    //exit();
}
if (key_exists('signup',$_POST))
{
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
    $email = $_POST['txtEmail'];
    if (key_exists('reklam',$_POST))
    {
        $reklam = true;
    }
    else
    {
        $reklam = false;
    }
    $controller = new UserController();
    $groupId = 2; //Detta är User gruppen.
    $controller->AddNewUser($username,$password,$email,$groupId,$reklam);
}
if (key_exists('addGroup',$_POST))
{
    $groupName = $_POST['txtGroupname'];
    $controller = new UserController();
    $controller->AddGroup($groupName);
}

if(key_exists('addImage',$_POST) && key_exists('productId',$_POST)) 
{
    $controller = new UploadController();
    $controller->AddProductImage($_POST['productId']);
}
?>



<?php 
//CART TRIGGERS!
Require_once('Cart.Controller.php');

// echo var_dump($_POST).'<br><br>';



if (isset($_POST['AddToCart'])) {
    $cart = new CartController();

    $cart->AddToCart($_POST['productID'],$_POST['amount'],$_POST['price']);
}

if (isset($_POST['updateCart'])) {
    $cart = new CartController();

    $cart->UpdateProductInCart($_POST['productID'],$_POST['amount']);
}

// if (isset($_SESSION['ShoppingCart'])) {
//     echo '<pre>', print_r($_SESSION['ShoppingCart']),'</pre>'.'<br><br>';
// }
?>


<?php 
//ORDER TRIGGERS!
Require_once('Order.Controller.php');

if (isset($_POST['betala'])) {
    $order = new OrderController();

    $order->SendOrder();
}



?>