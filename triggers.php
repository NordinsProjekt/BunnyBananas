<?php

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
if (key_exists('deleteGroup',$_POST))
{
    $groupId = $_POST['selGroups'];
    $controller = new UserController();
    $controller->RemoveGroup($groupId);
}

if(key_exists('addImage',$_POST) && key_exists('productId',$_POST)) 
{
    $controller = new UploadController();
    $controller->AddProductImage($_POST['productId']);
}

if (key_exists('logout',$_POST))
{
    session_destroy();
    header("Location: ./");
    exit();
}
?>

<?php 
//CART TRIGGERS!

if (isset($_POST['AddToCart'])) {
    $cart = new CartController();

    $cart->AddToCart($_POST['productID'],$_POST['amount'],$_POST['price']);
}

if (isset($_POST['updateCart'])) {
    $cart = new CartController();

    $cart->UpdateProductInCart($_POST['productID'],$_POST['amount']);
}

?>


<?php 
//ORDER TRIGGERS!

if (isset($_POST['betala']) && isset($_SESSION['ShoppingCart'])) {
    $order = new OrderController();
    $cart = new CartController();


    foreach ($_SESSION['ShoppingCart'] as $productID => $value){
        $amount = $value[0]; //Antal köp av en vara
        
    }

    $order->SendOrder();
    $cart->Checkout();

    
}

//----------------PRODUCT TRIGGERS!---------------------------

if (isset($_POST['submit-product'])) //Skapar ny produkt i DB
{
    $controller = new ProductController();
    $name = $_POST['new-product'];
    $category = $_POST['categories'];
    $color = $_POST['colors'];
    $description = $_POST['description'];
    $price = $_POST['new-price'];
    $balance = $_POST['balance'];

    $controller->insertProduct($name, $category, $color, $description, $price, $balance);
}

if (isset($_POST['update-product'])) //Uppdaterar produktdata i DB
{
    $controller = new ProductController();
    $id = $_POST['productID'];
    $name = $_POST['productName'];
    $category = $_POST['categories'];
    $color = $_POST['colors'];
    $description = $_POST['description'];
    $price = $_POST['update-price'];
    $balance = $_POST['balance'];
    $discontinued = $_POST['discontinued'];

    $controller->insertUpdatedProduct($id, $name, $category, $color, $description, $price, $balance, $discontinued);
    $addImage = new UploadController();
    if ($_FILES['fileToUpload']['name'] != "" || $_FILES['fileToUpload']['full_path'] != "" )
    {
        $addImage->AddProductImage($id);
    }   
}

if (isset($_POST['submit-color'])) //Skapar ny färg i DB
{
    $controller = new ProductController();
    $color = $_POST['new-color'];
    $controller->insertColor($color);
}

if (isset($_POST['submit-category'])) //Skapar ny kategori i DB
{
    $controller = new ProductController();
    $category = $_POST['new-category'];
    $controller->insertCategory($category);
}

if (isset($_POST['delete-color'])) //Raderar färg i DB
{
    $controller = new ProductController();
    $color = $_POST['color'];
    $controller->removeColor($color);
}

if (isset($_POST['delete-category'])) //Raderar kategori i DB
{
    $controller = new ProductController();
    $category = $_POST['category'];
    $controller->removeCategory($category);
}


if (isset($_POST['deletePic'])) //Tar bort bild från produkt
{
    $controller = new UploadController();

    $controller->DeleteProductImage($_GET['productID'], ($_POST['deletePicID']));
}


//----------------CURRENCY TRIGGERS!---------------------------
if(isset($_POST['currency'])) //ändrar Valuta på hela siten.
{
    $_SESSION['currency'] = $_POST['currency'];
}
?>