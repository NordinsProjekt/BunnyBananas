    <nav class="AdminNav">
        <a href="?admin=users">Hantera Användare</a>
        <a href="?admin=orders">Hantera Ordrar</a>
        <a href="?admin=products">Hantera Produkter</a>
        <details>
            <summary>Senaste databas meddelandet</summary>
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
