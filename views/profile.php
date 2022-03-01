<h1>Profilsida för <?php echo $_SESSION['username']; ?></h1>

<nav>
    <a href="?profile=users">Delivery Address</a>
    <a href="?profile=orders">See Orders</a>
</nav>
        <?php 
            if(key_exists('profile',$_GET))
            {
                switch($_GET['profile'])
                {
                    case "users":
                        require_once "deliveryaddress.php";
                        break;
                    case "orders":
                        require_once "userorders.php";
                        break;
                }
            }
        ?>

