<?php $orderController = new OrderController(); ?>
<h1>Profilsida för <?php echo $_SESSION['username']; ?></h1>

    <details>
    <summary>Mina Beställningar</summary>
    <div class="ProfileUser">  
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
</div>
</details>
<div class="AllOrders">
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

<?php 
$summa = 0;
foreach($orderController->ListSpecificOrder($_GET['orderID']) as $value){?>

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
    <?php $summa += $value['Price']*$value['Amount']; ?>
    
<!--END LOOP-->
<?php }?>
<tr><td colspan="9" style="text-align: right;"><b><?php echo "Summa ". $summa . ":-";?></b></td></tr>
</tbody>
</table>
</div>
<!--END IF-->
<?php }?>
<details class="ProfileLeverans">
        <summary>Min Adress</summary>
        <?php 
            require_once "deliveryaddress.php";
        ?>
</details>

