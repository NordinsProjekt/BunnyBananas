<?php

$userCtrl = new UserController();
$cartCtrl = new CartController();
require_once('triggers.php');
require_once('buildHTML.php');
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
    echo LoginForm();
}
?>
</nav>

<a href="./"><img src="img/sinus-logo-landscape -  small.png"></a>

<nav class="flex-row">
    <a class='LinkHeader' href="./">Hem</a>
    
    <a class='LinkHeader' href="./cart">Kundkorg</a>

    <p><?php echo $cartCtrl->CurrentSum(); ?>:- (<?php echo $cartCtrl->CurrentAmountOfItems(); ?>)</p>
</nav>


</header>