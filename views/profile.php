<h1>Profilsida för <?php echo $_SESSION['username']; ?></h1>

<div class="ProfileUser">
    <details>
        <summary>Show My Delivery Address</summary>
        <?php 
            require_once "deliveryaddress.php";
        ?>
    </details>
    
    <details>
        <summary>Show My Orders</summary>
        <?php 
            require_once "userorders.php";
        ?>
    </details>
</div>

