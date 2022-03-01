<?php 
$controller = new OrderController();
$rows = $controller->ListOrdersByUser($_SESSION['userId']);
?>
<h2>My Orders</h2>
<table>
<thead>
    <tr>
        <td>OrderID</td>
        <td>Date</td>
        <td>Sent</td>
        <td>Delivered</td>

    </tr>
</thead>
<tbody>
<?php foreach($rows as $value){?>
    <tr>
        <td><a href="?profile=orders&orderID=<?php echo $value['ID']?>"><?php echo $value['ID']?></a></td>
        <td><?php echo $value['Date']?></td>
        <td><?php echo $value['Sent']?></td>
        <td><?php echo $value['Delivered']?></td>
    </tr>

<?php }?>
</tbody>
</table>

<table>

<?php if (isset($_GET['orderID'])) {?>
    <thead>
    <tr>
        <td>OrderID</td>
        <td>ProductName</td>
        <td>Color</td>
        <td>Category</td>
        <td>Amount</td>
        <td>Price</td>
        <td>Discount</td>
        <td>Sent</td>
        <td>Delivered</td>
    </tr>
</thead>
<tbody>
<?php foreach($controller->ListSpecificOrder($_GET['orderID']) as $value){?>
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
<?php }?>
</tbody>
</table>
<?php }?>
