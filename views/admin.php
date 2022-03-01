<?php
require_once "User.Controller.php";
require_once "Order.Controller.php";
require_once "Products.controller.php";
require_once "triggers.php";
?>
    <nav>
        <a href="?admin=users">Hantera Användare</a>
        <a href="?admin=orders">Hantera Ordrar</a>
        <a href="?admin=products">Hantera Produkter</a>
    </nav>
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
