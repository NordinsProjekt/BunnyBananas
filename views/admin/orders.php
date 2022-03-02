<?php $orderController = new OrderController();?>
<div class="AllOrders">
<details>
    <summary>Visa Alla Beställningar</summary>
<h3 class="TitelHeader">Alla beställningar:</h3>
<table>
<thead>
    <tr>
        <th>Order ID</th>
        <th>Användar ID</th>
        <th>Datum</th>
        <th>Skickat</th>
        <th>Levererat</th>

    </tr>
</thead>
<tbody>
<?php foreach($orderController->ListAllOrders() as $value){?>
    <tr>
        <td><a href="?admin=orders&orderID=<?php echo $value['ID']?>"><?php echo $value['ID']?></a></td>
        <td><?php echo $value['UserID']?></td>
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
        <th>Användar ID</th>
        <th>Produktnamn</th>
        <th>Färg</th>
        <th>Kategori</th>
        <th>Antal</th>
        <th>Pris</th>
        <th>Rabatt</th>
        <th>Skickat</th>
        <th>Levererat</th>
    </tr>
</thead>
<tbody>
<?php foreach($orderController->ListSpecificOrder($_GET['orderID']) as $value){?>

    <tr>
        <td><?php echo $value['ID']?></td>
        <td><?php echo $value['UserID']?></td>
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