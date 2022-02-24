<?php
session_start();
require_once "BuildHtmlAdmin.php";
require_once "../controller.php";
require_once "../triggers.php";
?>

<?php
//Så länge en är inloggad så händer detta, ingen koll på användargrupp m.m.
    if (isset($_SESSION['is_logged_in']))
    {}
    else
    {
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/stil.css" media="screen" />
    <title>Main Page</title>
</head>
<body>
<header>
</header>
    <h1>Main Page</h1>
    <main>
        <section class="Add user">
            <h2>Add User></h2>
        <form method="post">
            <label for="txtUsername" id ="lblUsername" class="">Username: </label>
            <input type="text" id ="txtUsername" name="txtUsername" class="userInput" value="" size="30" /><br />
            <label for="txtPassword" id ="lblPassword" class="">Password: </label>
            <input type="password" id ="txtPassword" name="txtPassword" class="userInput" value="" size="30" /><br />
            <label for="txtEmail" id ="lblEmail" class="">Email: </label>
            <input type="email" id ="txtEmail" name="txtEmail" class="userInput" value="" size="30" /><br />
            <input type="submit" id="add" class="addButton" name="add" value="Add user" />
            <br />
        </form>
        </section>
    </main>
</body>
</html>
<?php
function ValidateLogin()
{
    if (key_exists('is_logged_in',$_SESSION))
    {
        if ($_SESSION['is_logged_in'])
        {
            return true;
        }
        return false;
    }
    return false;
}
?>