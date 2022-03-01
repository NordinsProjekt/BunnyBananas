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
    echo "<a href='./profile'>Profile</a>";
    if ($userCtrl->VerifyUserAdmin()) {

        echo "<a href='./admin'>Admin</a>";
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
    <a href="./">Hem</a>
    
    <a href="./cart">Kundvagn</a>

    <p><?php echo $cartCtrl->CurrentSum(); ?>:- (<?php echo $cartCtrl->CurrentAmountOfItems(); ?>)</p>
</nav>


</header>