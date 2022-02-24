<?php
session_start();
require_once "buildHTML.php";
require_once "triggers.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/stil.css" media="screen" />
    <title>Adminpanel</title>
</head>
<body>
<h1>Login</h1>
<?php
    if (isset($_SESSION['is_logged_in']))
    {
        header("Location: admin/index.php");
    }
    else
    {
        echo LoginForm();
    }
?>
</body>
</html>