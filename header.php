<?php

$userCtrl = new UserController();
$cartCtrl = new CartController();
$prodCtrl = new ProductController();

?>
<header class="header">
<nav class="flex-row">
<?php
if (isset($_SESSION['is_logged_in'])) 
{
    echo LogoutForm();
    echo "<a class='LinkHeader' href='./profile'>Profil</a>";
    if ($userCtrl->VerifyUserAdmin()) {

        echo "<a class='LinkHeader' href='./admin'>Adminpanelen</a>";
    }
}
else 
{
    echo "<div class='LoginFlex'>";
    echo LoginForm();
    echo "</div>";
}
?>
</nav>

<a href="./"><img src="img/sinus-logo-portrait - small.png"></a>

<div class="flex-row">
    <a class='LinkHeader' href="./">Hem</a>
    
    <a class='LinkHeader' href="./cart">Kundkorg</a>

    <p><?php echo currency($cartCtrl->CurrentSum()); ?>(<?php echo $cartCtrl->CurrentAmountOfItems(); ?>)</p>
</div>
<nav>

    <form method="GET" action="./search">
        <div class="flex-row">
            <input type="submit" value="Sök" name="search">
            <input type="text" name="searchCriteria" placeholder="Search..">
        </div>
        <div class="flex-row">
            <div class="">
                <a href="#" onclick="dropDown('category')" class="">Kategori</a>
                <div id="dropDownCategory" class="dropdown-content">
                    <?php foreach ($prodCtrl->listAllCategories() as $row){?>
                        <input type="checkbox" id="<?php echo $row['ID']?>" name="category[]" value="<?php echo $row['ID']?>"><label for="<?php echo $row['ID']?>"><?php echo $row['Name']?></label><br>
                    <?php } //END FOREACH?>
                </div>
            </div>

            <div class="">
                <a href="#" onclick="dropDown('color')" class="">Färg</a>
                <div id="dropDownColor" class="dropdown-content">
                    <?php foreach ($prodCtrl->listAllColors() as $row){?>
                        <input type="checkbox" id="<?php echo $row['ID']?>" name="color[]" value="<?php echo $row['ID']?>"><label for="<?php echo $row['ID']?>"><?php echo $row['Name']?></label><br>
                    <?php } //END FOREACH?>
                    
                </div>
            </div>
        </div>

    </form>
</nav>


<form action="#" method="post">
<input type="submit" name="currency" value="SEK" />
<input type="submit" name="currency" value="EUR" />
</form>


</header>