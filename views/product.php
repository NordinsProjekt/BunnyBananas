<?php $productController = new ProductController();
//Felhantering om någon bråkar med GET
if (!isset($_GET['productID']))
{
    header("Location: ./");
    exit();
}

$images = "";
$imgdots = "";
$imgCounter = 0;
$displayBlock = 1;
$dir = 'img/products/' . $_GET['productID'];

$product = $productController->listProduct($_GET['productID']);
//Felhantering om någon bråkar med GET
if ($product == false)
{
    header("Location: ./");
    exit();
}

if (file_exists($dir)) {
    $imagePaths = scandir($dir);

    //clean $imagePaths
    unset($imagePaths[0]);
    unset($imagePaths[1]);

    if (isset($imagePaths)) {
        foreach ($imagePaths as $img) {           

                $imgCounter += 1;
                //paketera varje image
                if ($displayBlock == 1) {
                    $images .= "<div class='mySlides fade' style='display: block;'>"; //set display:block för första bilden.
                    $displayBlock = 0;
                }else {
                    $images .= "<div class='mySlides fade''>";
                }                
                $images .= "<img src='img/products/" . $_GET['productID'] . "/" . $img . " '>";
                $images .= "</div>";

                //bygg imagedots om det är fler än en bild
                if (count($imagePaths) > 1) {
                $imgdots .= "<span class='dot' onclick='currentSlide($imgCounter)'></span>";
                }
            
        }
        //lägg till pilar om det är mer än en bild
        if (count($imagePaths) > 1) {
            $images .= "<a class='prev' onclick='plusSlides(-1)'>&#10094;</a>";
            $images .= "<a class='next' onclick='plusSlides(1)'>&#10095;</a>";
        }
    }
}
?>

<main class="main flex-col">
    <div class="ProductCardLarge">      
        <div>
            <div class="slideshow-container">

                <?php echo $images;?>

            </div>
            <br>
            <div style="text-align:center">
                <?php echo $imgdots;?>
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
                
                    <?php if($product['Discontinued'] == 0)
                    {?>
                        <form action='' method='post'>
                            <input type='Hidden' name='productID' value='<?php echo $_GET['productID']; ?>'/>
                            <input type='Hidden' name='price' value='<?php echo $product['Price']; ?>'/>
                            <input class='inputnumber' type='number' name='amount' value='1' min='1'max='20'/>
                            <input type='Hidden' name='AddToCart' value='AddToCart'/>
                            <input type='submit' id='submit' name='submit' value='KÖP!' />
                        </form>
                    <?php }else{?>
                        <br />
                        <p>Produkten har utgått ur sortiment</p>
                    <?php }?>
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