<?php $orderController = new OrderController();?>
<details>
    <summary>Show All Orders</summary>
<h3>All orders:</h3>
<table>
<thead>
    <tr>
        <th>OrderID</th>
        <th>UserID</th>
        <th>Date</th>
        <th>Sent</th>
        <th>Delivered</th>

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


<?php if (isset($_GET['orderID'])) {?>
    <table>
    <thead>
    <tr>
        <th>OrderID</th>
        <th>UserID</th>
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