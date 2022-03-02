<?php $orderController = new OrderController(); ?>
<h1>Profilsida för <?php echo $_SESSION['username']; ?></h1>

<div class="ProfileUser">  
    <details>
    <summary>Mina Beställningar</summary>
    <h2 class="TitelHeader">Beställningar:</h2>
<table>
<thead>
    <tr>
        <th>Order ID</th>
        <th>Datum</th>
        <th>Skickad</th>
        <th>Levererad</th>

    </tr>
</thead>
<tbody>
<?php foreach($orderController->ListOrdersByUser($_SESSION['userId']) as $value){?>
    <tr>
        <td><a href="?profile=orders&orderID=<?php echo $value['ID']?>"><?php echo $value['ID']?></a></td>
        <td><?php echo $value['Date']?></td>
        <td><?php echo $value['Sent']?></td>
        <td><?php echo $value['Delivered']?></td>
    </tr>

<?php }?>
</tbody>
</table>
</details>
</div>
<?php if (isset($_GET['orderID'])) {?>
    <table>
    <thead>
    <tr>
        <th>Order ID</th>
        <th>Produktnamn</th>
        <th>Färg</th>
        <th>Kategori</th>
        <th>Antal</th>
        <th>Pris</th>
        <th>Rabatt</th>
        <th>Skickad</th>
        <th>Levererad</th>
    </tr>
</thead>
<tbody>
<?php foreach($orderController->ListSpecificOrder($_GET['orderID']) as $value){?>

    <tr>
        <td><?php echo $value['ID']?></td>
        <td><?php echo $value['ProductName']?></td>
        <td><?php echo $value['Color']?></td>
        <td><?php echo $value['Category']?></td>
        <td><?php echo $value['Amount']?></td>
        <td><?php echo $value['Price']?></td>
        <td><?php echo $value['Discount']?></td>
        <td><?php echo $value['Sent']?></td>
        <td><?php echo $value['Delivered']?></td>
    </tr>
    
<!--END LOOP-->
<?php }?>
</tbody>
</table>

<!--END IF-->
<?php }?>
<details class="ProfileLeverans">
        <summary>Min Adress</summary>
        <?php 
            require_once "deliveryaddress.php";
        ?>
</details>

