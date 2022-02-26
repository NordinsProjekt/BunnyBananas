<?php $controller = new ProductController();?>

<h3>Available products:</h3>

 <h2>Products</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Category</th>
        <th>Name</th>
        <th>Price</th>
        <th>Balance</th>
        <th>Discontinued</th>
    </tr>

    <?foreach ($arr as $row){?>
    <tr>
        <td><?$row["ID"]?></td>
        <td><?$row["Category"]?></td>
        <td><?$row["Name"]?></td>
        <td><?$row["Price"]?></td>
        <td><?$row["Balance"]?></td>
        <td><?$row["Discontinued"]?></td>
    </tr>
    <?}?>
</table>


