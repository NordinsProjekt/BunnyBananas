<?php $productController = new ProductController();


$images = "";
$dir = 'img/products/' . $_GET['productID'];

$product = $productController->listProduct($_GET['productID']);

if (file_exists($dir)) {
    $imagePaths = scandir($dir);

    if (isset($imagePaths)) {
        foreach ($imagePaths as $img) {
            if ($img != '.' && $img != '..') {
                $images .= "<div class='carousel-cell'>";
                $images .= "<img class='carousel-cell-image' data-flickity-lazyload='img/products/" . $_GET['productID'] . "/" . $img . "' />";
                $images .= "</div>";
            }

        }
    }

}
?>

<main class="main flex-col">
    <div class="ProductCardLarge">
        
    
    <div style="background-color: red; width: 400px;">

        <div class="carousel"data-flickity='{ "lazyLoad": true }'>
            <?php echo $images;?>
        </div>

            
    </div>
        <div class="InfoText">
            <p><h2><?php echo $product['Name']; ?></h2></p>
            <p><?php echo $product['Category']; ?></p>
            <p>färg:<?php echo $product['Color']; ?></p>            
            <p><?php echo $product['Description']; ?></p>
            <p><?php echo $product['Balance']; ?> kvar i lager!</p>
            <p><h2><?php echo currency($product['Price']); ?></h2></p>
            <div class='buybox'>
                <form action='' method='post'>
                    <input type='Hidden' name='productID' value='<?php echo $_GET['productID']; ?>'/>
                    <input type='Hidden' name='price' value='<?php echo $product['Price']; ?>'/>
                    <input class='inputnumber' type='number' name='amount' value='1' min='1'max='20'/>
                    <input type='Hidden' name='AddToCart' value='AddToCart'/>
                    <input type='submit' id='submit' name='submit' value='KÖP!' />
                </form>
            </div>
        </div>

    </div>


    <div class="flex-col">
        <p>Gillar du <?php echo $product['Name']?> så kommer du älska!</p>
        <div class="flex-row">
            <?php foreach ($productController->listSimilarProducts(3, $product['CategoryID'], $_GET['productID']) as $p) { ?>

                <?php echo ProductCard($p['ID'],$p['Name'],$p['Category'],$p['Color'],$p['Price'],$p['Balance']); ?>

            <?php }?>
        </div>
    </div>

    
    <div class="flex-col">
        <p>Kunder som spanade in <?php echo $product['Name']?> kollade även på!</p>
        <div class="flex-row">
            <?php foreach ($productController->listLookedAtProducts(3, $product['CategoryID'], $_GET['productID']) as $p) { ?>

                <?php echo ProductCard($p['ID'],$p['Name'],$p['Category'],$p['Color'],$p['Price'],$p['Balance']); ?>

            <?php }?>
        </div>
    </div>

</main>



