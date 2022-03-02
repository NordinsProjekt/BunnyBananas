<?php $cartController = new CartController(); ?>
<?php $ctrlr = new UserController(); ?>

<main class="cart">

<?php if (isset($_SESSION['ShoppingCart'])) {?>

    <table>
        <thead>
            <tr>
                <th></th>
                <th>vara:</th>
                <th>typ:</th>
                <th>färg:</th>
                <th>pris:</th>
                <th>antal:</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartController->listCart() as $product) {?>
                <?php echo CartProduct($product['ID'],$product['Name'],$product['Category'],$product['Color'],$product['Price'],$product['Balance']); ?>

            <?php }?>
        </tbody>
    </table>
    <?php 
    $sum = 0;
    foreach($_SESSION['ShoppingCart'] as $productID){ 
        
        $sum += ($productID[0] * $productID[1]);

    }?>

    Totalt: <?php echo $sum;?>:-


    <?php if(key_exists('userId', $_SESSION)) {?>
                

        <h2>Leveransadress:</h2>
        <?php $row = $ctrlr->ListShippingAddress(); ?>
        <form class="profileForm" method="post" action="./checkout">
            <label for="fname">Förnamn:</label><br>
            <input type="text" id="fname" name="txtFirstname" value="<?php echo $row['Firstname']; ?>"><br>
            <label for="txt">Efternamn:</label><br>
            <input type="text" id="lname" name="txtLastname" value="<?php echo $row['Lastname']; ?>"><br>
            <label for="address">Adress</label><br>
            <input type="text" id="address" name="txtAddress" value="<?php echo $row['Adress1']; ?>"><br>
            <label for="address2">Adress 2:</label><br>
            <input type="text" id="address2" name="txtAddress2" value="<?php echo $row['Adress2']; ?>"><br>
            <label for="postalcode">Postnummer:</label><br>
            <input type="text" id="postalcode" name="txtPostalcode" value="<?php echo $row['Postnummer']; ?>"><br>
            <label for="postalarea">Postort:</label><br>
            <input type="text" id="postalarea" name="txtPostalarea" value="<?php echo $row['Postort']; ?>"><br>
            <label for="country">Land:</label><br>
            <input type="text" id="country" name="txtCountry" value="<?php echo $row['Land']; ?>"><br>
            <input type="submit" name="betala" value="Godkänn!" />
        </form>
    
    <?php }?>

<?php } else { ?>
    Din varukorg är tom!
<?php }?>

</main>