<?php
function LoginForm()
{
    $text = "";
    $text .= "<a href='./signup'>Skapa konto</a>";
    $text .= "<form method='post'>";
    $text .= "<label for='txtUsername' id ='lblUsername' class=''>Username: </label>";
    $text .= "<input type='text' id ='txtUsername' name='txtUsername' class='userInput' value='' size='10' />";
    $text .= "<label for='txtPassword' id ='lblPassword' class=''>Password: </label>";
    $text .= "<input type='password' id ='txtPassword' name='txtPassword' class='userInput' value='' size='10' />";
    $text .= "<input type='submit' id='login' class='loginButton' name='login' value='Login' />";
    $text .= "</form>";
    return $text;
}
function LogoutForm()
{
    $text = "";
    $text .= "<form method='post'>";
    $text .= "<input type='submit' id='logout' class='logoutButton' name='logout' value='Logout' />";
    $text .= "</form>";
    return $text;
}
function ProfileButtonForm()
{
    $text = "";
    $text .= "<form method='post'>";
    $text .= "<input type='submit' id='profile' class='profileButton' name='profile' value='".$_SESSION['username']." profile' />";
    $text .= "</form>";
    return $text;
}
function AdminPanelButton()
{
    $text = "";
    $text .= "<form method='post'>";
    $text .= "<input type='submit' id='admin' class='adminButton' name='adminButton' value='Admin' />";
    $text .= "</form>";
    return $text;
}

function ProductCard($productID, $name, $category, $color,$price, $Balance){

    $text = "";
    $text .= "$name<br>";
    $text .= "$category<br>";
    $text .= "$color<br>";
    $text .= "$price:-<br>";
    $text .= "<form action='' method='post'>";
    $text .= "<input type='Hidden' name='productID' value='$productID'/>";
    $text .= "<input type='number' name='amount' value='1' min='1'max='20'/>";
    $text .= "<input type='Hidden' name='AddToCart' value='AddToCart'/>";
    $text .= "<input type='submit' id='submit' name='submit' value='Add To Cart' />";
    $text .= "</form>";
    return $text;

}

function CartProduct($productID, $name, $category, $color, $price, $Balance){

    $text = "";
    $text .= "$name<br>";
    $text .= "$category<br>";
    $text .= "$color<br>";
    $text .= "$price:-<br>";
    $text .= "<form action='' method='post'>";
    $text .= "<input type='Hidden' name='productID' value='$productID'/>";
    $text .= $_SESSION['ShoppingCart'][$productID]."    <input type='number' name='amount' value='".$_SESSION['ShoppingCart'][$productID]."' min='0' max='99'/>";
    $text .= "<input type='Hidden' name='updateCart' value='updateCart'/>";
    $text .= "<input type='submit' id='submit' name='submit' value='Update' />";
    $text .= "</form>";
    return $text;

}



?>