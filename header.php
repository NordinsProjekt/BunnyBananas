<?php 
require_once('triggers.php');
require_once('buildHTML.php');
if (isset($_SESSION['is_logged_in']))
{
    echo LogoutForm();
    echo ProfileButtonForm();
}
else
{
    echo LoginForm();
}
?>
<?php 