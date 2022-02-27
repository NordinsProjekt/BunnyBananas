<?php
require_once "User.Controller.php";

if (key_exists('addUser',$_POST) && key_exists('txtUsername',$_POST) && 
key_exists('txtPassword',$_POST) && key_exists('txtEmail',$_POST) && key_exists('selGroups',$_POST))
{
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
    $email = $_POST['txtEmail'];
    $groupId = (int)$_POST['selGroups'];
    $reklam = false;
    if ($username == "" or $password == "" or $email == "")
    {
        echo "Fyll i alla fält tack";
        exit();
    }
    $controller = new UserController();
    $controller->AddNewUser($username,$password,$email,$groupId,$reklam);
}

if (key_exists('login',$_POST))
{
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
    if ($username == "" or $password == "")
    {
        echo "Fyll i alla fält tack";
        header("Location: index.php");
        exit();
    }
    $controller = new UserController();
    $controller->VerifyUser($username,$password);
    header("Refresh: 0");
    exit();
}

if (key_exists('logout',$_POST))
{
    session_unset();
    session_destroy();
    header("Location: ./");
    exit();
}

if (key_exists('profile',$_POST))
{
    header("Location: ./profile");
    exit();
}

if (key_exists('adminButton',$_POST))
{
    header("Location: ./admin2");
    exit();
}

if (key_exists('saveProfile',$_POST))
{
    //Dessa är frivillga fält i profilen.
    //Ingen kontroll om de är tomma.
    $controller = new UserController();
    $controller->SaveShippingAddress($_POST['txtFirstname'],$_POST['txtLastname'],
    $_POST['txtAddress'],$_POST['txtAddress2'], $_POST['txtPostalcode'],
    $_POST['txtPostalarea'],$_POST['txtCountry']);
    header("Location: ./profile");
    exit();
}
if (key_exists('signup',$_POST))
{
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
    $email = $_POST['txtEmail'];
    if (key_exists('reklam',$_POST))
    {
        $reklam = true;
    }
    else
    {
        $reklam = false;
    }
    $controller = new UserController();
    $groupId = 2; //Detta är User gruppen.
    $controller->AddNewUser($username,$password,$email,$groupId,$reklam);
}
if (key_exists('addGroup',$_POST))
{
    $groupName = $_POST['txtGroupname'];
    $controller = new UserController();
    $controller->AddGroup($groupName);
}
?>
