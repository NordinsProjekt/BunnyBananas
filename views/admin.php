    <nav class="AdminNav">
        <a href="?admin=users">Hantera användare</a>
        <a href="?admin=orders">Hantera ordrar</a>
        <a href="?admin=products">Hantera produkter</a>
        <details>
            <summary>Senaste databasmeddelandet</summary>
            <p><?php echo $_SESSION['Message'];?></p>
        </details>
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
