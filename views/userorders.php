<?php 
$controller = new OrderController();
$rows = $controller->ListOrdersByUser($_SESSION['userId']);
?>
<h2>My Orders</h2>
<table>
<thead>
    <tr>
        <th>OrderID</th>
        <th>Date</th>
        <th>Sent</th>
        <th>Delivered</th>
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



<?php if (isset($_GET['orderID'])) {?>
    <table>
    <thead>
    <tr>
        <th>OrderID</th>
        <th>ProductName</th>
        <th>Color</th>
        <th>Category</th>
        <th>Amount</th>
        <th>Price</th>
        <th>Discount</th>
        <th>Sent</th>
        <th>Delivered</th>
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
