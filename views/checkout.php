<?php $orderController = new OrderController();?>


<?php if (isset($_POST['betala'])) {?>

    Tack för din order!<br>
    Ditt order nummer är: <?php echo $orderController->ListLastOrderByUserId($_SESSION['userId'])?><br>

    Tack! Du har köpt följande:<br>

    <table>
        <thead>
        <tr>
            <td>ProductName</td>
            <td>Color</td>
            <td>Category</td>
            <td>Amount</td>
            <td>Price</td>
        </tr>
    </thead>
        <tbody>
        <?php foreach($orderController->ListSpecificOrder($orderController->ListLastOrderByUserId($_SESSION['userId'])) as $value){?>

            <tr>
                <td><?php echo $value['ProductName']?></td>
                <td><?php echo $value['Color']?></td>
                <td><?php echo $value['Category']?></td>
                <td><?php echo $value['Amount']?></td>
                <td><?php echo $value['Price']?></td>
            </tr>
        <?php } //END FOREACH ?>
        </tbody>
    </table>

<?php } else { header('Location: .'); } //ENDIF ?>

