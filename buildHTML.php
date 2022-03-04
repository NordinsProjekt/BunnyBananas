<?php
function LoginForm()
{
    $text = "";
    $text .= "<form method='post'>";
    $text .= "<input type='text' id ='txtUsername' placeholder='Användarnamn' name='txtUsername' class='userInput' value='' size='12' />";
    $text .= "<input type='password' id ='txtPassword' placeholder='Lösenord' name='txtPassword' class='userInput' value='' size='7' />";
    $text .= "<input type='submit' id='login' class='loginButton' name='login' value='Login' />";
    $text .= "</form>";
    $text .= "<a class='LinkHeader' href='./signup'>Skapa konto</a>";
    return $text;
}

function AdminButton()
{
    $text = "";
    $text .= "<form method='post'>";
    $text .= "<input type='submit' id='adminButton' class='adminButton' name='adminButton' value='Admin' />";
    $text .= "</form>";
    return $text;
}

function ProfileButton()
{
    $text = "";
    $text .= "<form method='post'>";
    $text .= "<input type='submit' id='profile' class='profileButton' name='profile' value='Profile' />";
    $text .= "</form>";
    return $text;
}

function LogoutForm()
{
    $text = "";
    $text .= "<form method='post'>";
    $text .= "<input type='submit' id='logout' class='logoutButton' name='logout' value='Logga ut' />";
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

function ShowAllUsers(array $arr)
{

    $page = "<h2 class='TitelHeader'>Alla användare/kunder</h2>";
    $page .="<table><thead><tr><th>ID</th><th>Rättigheter</th><th>Användarnamn</th><th>Email</th><th>Aktiv</th></tr></thead>";

    foreach ($arr as $row => $user) 
    {
        $page .= "<tr>";
        $page .= "<td>" . $user['ID'] . "</td><td>" . $user['GroupName'] . "</td> <td>". $user['Username'] . "</td><td>" . $user['Email'] . "</td>";
        if ($user['Disable'] == 0)
        {
            $page .= "<td>Yes</td>";
        }
        else
        {
            $page .= "<td>No</td>";
        }
        $page .= "</tr>";
    }
    $page .="</table>";
    return $page;
}

function ProductCard($productID, $name, $category, $color,$price, $Balance){

    $text = "";
    $text .= "<div class='ProductCard'>";

    $dir = 'img/products/'.$productID;

    if (file_exists($dir)) {
        $imagePaths = scandir($dir);
    
        if (isset($imagePaths)){
            foreach ($imagePaths as $img) {
                if ($img != '.' && $img != '..') {
                    $text .= "<a href='./product?productID=".$productID."'><img src='img/products/".$productID."/".$img."' ></a>";
                    break;
                }
                
            }
        } 
    }
     
    $text .= "<p>$name</p>";
    $text .= "<p>$category</p>";
    $text .= "<p>$color</p>";
    $text .= "<div class='buybox'>";
    $text .= "  <p>".currency($price)."</p>";
    if ($Balance > 0) {
        $text .= "  <form action='' method='post'>";
        $text .= "      <input type='Hidden' name='productID' value='$productID'/>";
        $text .= "      <input type='Hidden' name='price' value='$price'/>";
        $text .= "      <input class='inputnumber' type='number' name='amount' value='1' min='1'max='$Balance'/>";
        $text .= "      <input type='Hidden' name='AddToCart' value='AddToCart'/>";
        $text .= "      <input type='submit' id='submit' name='submit' value='KÖP!' />";
        $text .= "  </form>";
    }
    else {
        $text .= "<p><b>Slut i lager</b></p>";
    }
    $text .= "</div>";
    $text .= "</div>";

    return $text;

}

function CartProduct($productID, $name, $category, $color, $price, $Balance){


    $text = "";
    $productImg = "";

    $dir = 'img/products/'.$productID;

    if (file_exists($dir)) {
        $imagePaths = scandir($dir);
    
        if (isset($imagePaths)){
            foreach ($imagePaths as $img) {
                if ($img != '.' && $img != '..') {
                    $productImg = "<img src='img/products/".$productID."/".$img."' height='40px'>";
                }
            }
        } 
    }
    
    $text .= "      <tr>";
    $text .= "          <td>$productImg</td>";
    $text .= "          <td><p>$name</p></td>";
    $text .= "          <td><p>$category</p></td>";
    $text .= "          <td><p>$color</p></td>";
    $text .= "          <td><p>".currency($_SESSION['ShoppingCart'][$productID][1])."</p></td>";
    $text .= "        <form class='flex-row' action='' method='post'><input type='Hidden' name='productID' value='$productID'/>";
    $text .= "          <td>".$_SESSION['ShoppingCart'][$productID][0]."</td>";
    $text .= "          <td><input class='inputnumber' type='number' name='amount' value='".$_SESSION['ShoppingCart'][$productID][0]."' min='0' max='99'/><input type='submit' id='submit' name='submit' value='Update' /></td>";
    $text .= "        <input type='Hidden' name='updateCart' value='updateCart'/>";
    $text .= "        </form>";
    $text .= "        <form action='' method='post'>";
    $text .= "        <input type='Hidden' name='updateCart' value='updateCart'/>";
    $text .= "        <input type='Hidden' name='productID' value='$productID'/>";
    $text .= "        <input type='Hidden' name='amount' value='0'/>";
    $text .= "          <td><input type='submit' id='submit' name='submit' value='Delete' /></td>";
    $text .= "        </form>";
    $text .= "      </tr>";



    return $text;

}



?>