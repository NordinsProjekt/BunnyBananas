<?php 
$userCtrl = new UserController();
require_once('triggers.php');
require_once('buildHTML.php');
if (isset($_SESSION['is_logged_in']))
{
    echo LogoutForm();
    echo "<a href='./profile'>Profile</a>";
    if ($userCtrl->VerifyUserAdmin())
    {
        
        echo "<a href='./admin'>Admin</a>";
    }
}
else
{
    echo LoginForm();
}
?>
<?php 