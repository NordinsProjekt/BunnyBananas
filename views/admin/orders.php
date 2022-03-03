<?php $orderController = new OrderController();?>

<details>
    <summary>Visa alla beställningar</summary>
<div class="AllOrders">
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
</div>
</details>

<div class="AllOrders">
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
<?php $order = $orderController->ListSpecificOrder($_GET['orderID']);
$summa = 0;?>
<?php foreach($order as $value){?>

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
<?php $summa+= $value['Amount']*$value['Price']; }?>
<tr><td colspan="10" style="text-align: right;"><b><?php echo "Summa ".$summa.":-";?></b></td></tr>
</tbody>
</table>
<br />
<table>
    <thead>
        <tr>
            <th>Förnamn</th>
            <th>Efternamn</th>
            <th>Adress1</th>
            <th>Adress2</th>
            <th>Postort</th>
            <th>Postnummer</th>
            <th>Land</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $order[0]['Firstname'];?></td>
            <td><?php echo $order[0]['Lastname'];?></td>
            <td><?php echo $order[0]['Adress1'];?></td>
            <td><?php echo $order[0]['Adress2'];?></td>
            <td><?php echo $order[0]['Postort'];?></td>
            <td><?php echo $order[0]['Postnummer'];?></td>
            <td><?php echo $order[0]['Land'];?></td>
        </tr>
    </tbody>
</table>

<!--END IF-->
<?php }?>
</div>