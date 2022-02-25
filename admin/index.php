<?php
session_start();
require_once "../User.Controller.php";
require_once "../triggers.php";
?>

<?php
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
    <?php require_once('../header.php'); ?>
</header>
    <h1>Main Page</h1>
    <main>
        <section class="Add user">
            <h2>Add User</h2>
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
        <section>
            <?php 
            echo "Session var_dump <br />";
            var_dump($_SESSION);
            $controller = new UserController();

            echo "<br />Is user Admin? " . $controller->VerifyUserAdmin();
            ?>
        </section>
    </main>
</body>
</html>