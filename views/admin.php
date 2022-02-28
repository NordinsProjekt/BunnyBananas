<?php
require_once "User.Controller.php";
require_once "triggers.php";
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
    <nav>
        <a href="?admin=users">Manage Users</a>
        <a href="?admin=orders">Manage Orders</a>
        <a href="?admin=products">Manage Products</a>
    </nav>
    <main>
        <?php 
            if(key_exists('admin',$_GET))
            {
                switch($_GET['admin'])
                {
                    case "users":
                        require_once "admin/users.php";
                        break;
                    case "orders":
                        require_once "admin/orders.php";
                        break;
                    case "products":
                        require_once "admin/products.php";
                        break;
                }
            }
        ?>
    </main>
</body>
</html>