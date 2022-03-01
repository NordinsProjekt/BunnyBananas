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

function UploadFile($productId)
{
    $text ="";
    $text .= "<form method='post' enctype='multipart/form-data'>";
    $text .= "<label for='fileToUpload'>Select image to upload:</label>";
    $text .= "<input type='file' name='fileToUpload' id='fileToUpload' />";
    $text .= "<input type='hidden' name='productId' value='" . $productId . "' />";
    $text .= "<input type='submit' value='Upload Image' name='addImage' />";
    $text .= "</form>";
    return $text;
}

function ProductCard($productID, $name, $category, $color,$price, $Balance){

    $text = "";
    
    $dir = 'img/products/'.$productID;

    if (file_exists($dir)) {
        $imagePaths = scandir($dir);
    
        if (isset($imagePaths)){
            foreach ($imagePaths as $img) {
                if ($img != '.' && $img != '..') {
                    $text .= "<img src='img/products/".$productID."/".$img."' height='150px'>";
                }
                
            }
        } 
    }
    $text .= "<br>";



    
    $text .= "$name<br>";
    $text .= "$category<br>";
    $text .= "$color<br>";
    $text .= "$price:-<br>";
    $text .= "<form action='' method='post'>";
    $text .= "<input type='Hidden' name='productID' value='$productID'/>";
    $text .= "<input type='Hidden' name='price' value='$price'/>";
    $text .= "<input type='number' name='amount' value='1' min='1'max='20'/>";
    $text .= "<input type='Hidden' name='AddToCart' value='AddToCart'/>";
    $text .= "<input type='submit' id='submit' name='submit' value='Add To Cart' />";
    $text .= "</form>";
    return $text;

}

function CartProduct($productID, $name, $category, $color, $price, $Balance){


    $text = "";
    
    $dir = 'img/products/'.$productID;

    if (file_exists($dir)) {
        $imagePaths = scandir($dir);
    
        if (isset($imagePaths)){
            foreach ($imagePaths as $img) {
                if ($img != '.' && $img != '..') {
                    $text .= "<img src='img/products/".$productID."/".$img."' height='50px'>";
                }
            }
        } 
    }
    $text .= "<br>";



    $text .= "$name<br>";
    $text .= "$category<br>";
    $text .= "$color<br>";
    $text .= $_SESSION['ShoppingCart'][$productID][1].":-<br>";
    $text .= "<form action='' method='post'>";
    $text .= "<input type='Hidden' name='productID' value='$productID'/>";
    $text .= $_SESSION['ShoppingCart'][$productID][0]."    <input type='number' name='amount' value='".$_SESSION['ShoppingCart'][$productID][0]."' min='0' max='99'/>";
    $text .= "<input type='Hidden' name='updateCart' value='updateCart'/>";
    $text .= "<br>";
    $text .= "<input type='submit' id='submit' name='submit' value='Update' />";
    $text .= "</form>";
    
    //deletebutton
    $text .= "<form action='' method='post'>";
    $text .= "<input type='Hidden' name='productID' value='$productID'/>";
    $text .= "<input type='Hidden' name='amount' value='0'/>";
    $text .= "<input type='Hidden' name='updateCart' value='updateCart'/>";
    $text .= "<input type='submit' id='submit' name='submit' value='Delete' />";
    $text .= "</form>";
    return $text;

}



?>