<?php $orderController = new OrderController();
$lastOrderID = $orderController->ListLastOrderByUserId($_SESSION['userId']);
?>


<?php if (isset($_POST['betala'])) {?>

    <main class="cart">
            
        <p>Tack för din order!</p>
        <p>Ordernummer: <b><?php echo $lastOrderID?></b></p>

        <table>
            <thead>
            <tr>
                <th>ID:</th>
                <th>Produkt:</th>
                <th>Färg:</th>
                <th>Kategori:</th>
                <th>Antal:</th>
                <th>Pris:</th>
            </tr>
        </thead>
            <tbody>
            <?php foreach($orderController->ListSpecificOrder($lastOrderID) as $value){?>

                <tr>
                    <td><?php echo $value['ProductID']?></td>
                    <td><?php echo $value['ProductName']?></td>
                    <td><?php echo $value['Color']?></td>
                    <td><?php echo $value['Category']?></td>
                    <td><?php echo $value['Amount']?></td>
                    <td><?php echo $value['Price']?>:-</td>
                </tr>
            <?php } //END FOREACH ?>

                <tr>
                    <td colspan="6" style="text-align:right;"><b>Summa: <?php echo $orderController->ListTotalCostSpecificOrder($lastOrderID); ?>:-</b></td>
                </tr>
            </tbody>
        </table>

    </main>

<?php } else { header('Location: .'); } //ENDIF Redirect if you try to access without correct _POST ?>

