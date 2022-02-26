<?php
require_once "User.Controller.php";

if (key_exists('add',$_POST) && key_exists('txtUsername',$_POST) && 
key_exists('txtPassword',$_POST) && key_exists('txtEmail',$_POST) )
{
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
    $email = $_POST['email'];

    if ($username == "" or $password == "" or $email == "")
    {
        echo "Fyll i alla fält tack";
        exit();
    }
    $controller = new UserController();
    $controller->AddNewUser($username,$password,$email);
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
}
?>
