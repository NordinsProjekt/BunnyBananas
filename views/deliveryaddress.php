<?php 
    $controller = new UserController();
    $row = $controller->ListShippingAddress(); 
?>
<section class="LeveransAdress">
<h2>Adress</h2>
<form class="profileForm" method="post">
    <label for="fname">Förnamn:</label><br />
    <input type="text" id="fname" name="txtFirstname" value="<?php echo $row['Firstname']; ?>"><br />
    <label for="txt">Efternamn:</label><br />
    <input type="text" id="lname" name="txtLastname" value="<?php echo $row['Lastname']; ?>"><br />
    <label for="address">Adress</label><br />
    <input type="text" id="address" name="txtAddress" value="<?php echo $row['Adress1']; ?>"><br />
    <label for="address2">Adress 2:</label><br />
    <input type="text" id="address2" name="txtAddress2" value="<?php echo $row['Adress2']; ?>"><br />
    <label for="postalcode">Postnummer:</label><br />
    <input type="text" id="postalcode" name="txtPostalcode" value="<?php echo $row['Postnummer']; ?>"><br />
    <label for="postalarea">Postort:</label><br />
    <input type="text" id="postalarea" name="txtPostalarea" value="<?php echo $row['Postort']; ?>"><br />
    <label for="country">Land:</label><br />
    <input type="text" id="country" name="txtCountry" value="<?php echo $row['Land']; ?>"><br />
    <input type="checkbox" id="reklam" name="reklam" value="ja" checked />
    <label for="reklam"> Få exklusiva erbjudanen via email? </label><br /><br />
    <input type="submit" name="saveProfile" value="Spara" />
</form>
</section>