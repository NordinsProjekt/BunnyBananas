<?php $productController = new ProductController(); 

$images = "";
$dir = 'img/products/'.$_GET['productID'];

$product = $productController->listProduct($_GET['productID']);



if (file_exists($dir)) {
    $imagePaths = scandir($dir);

    if (isset($imagePaths)){
        foreach ($imagePaths as $img) {
            if ($img != '.' && $img != '..') {
                $images .= "<img src='img/products/".$_GET['productID']."/".$img."' height='500px'>";
            }
            
        }
    } 
}
?>

<main class="main">
    <div class="ProductCardLarge">
        <div>
            <?php echo $images;?>
        </div>
        <div class="InfoText">
            <p><h2><?php echo $product[0]['Name'];?></h2></p>
            <p><?php echo $product[0]['Category'];?></p>
            <p>färg:<?php echo $product[0]['Color'];?></p>            
            <p><?php echo $product[0]['Description'];?></p>
            <p><?php echo $product[0]['Balance'];?> kvar i lager!</p>
            <p><h2><?php echo $product[0]['Price'];?>:-</h2></p>
            <div class='buybox'>
                <form action='' method='post'>
                    <input type='Hidden' name='productID' value='<?php echo $_GET['productID'];?>'/>
                    <input type='Hidden' name='price' value='<?php echo $product[0]['Price'];?>'/>
                    <input class='inputnumber' type='number' name='amount' value='1' min='1'max='20'/>
                    <input type='Hidden' name='AddToCart' value='AddToCart'/>
                    <input type='submit' id='submit' name='submit' value='KÖP!' />
                </form>
            </div>
        </div>
    </div>
</main>

