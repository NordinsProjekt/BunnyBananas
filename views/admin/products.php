<?php
$controller = new ProductController();
echo "<h3>Add new product</h3>";
            echo "<form action='#' method='post'>";
                echo "<input type='text' id='new-product' name='new-product' placeholder='Product name'><br><br>";
                echo "<select name='categories' id='categories'>";
                echo "<option value=''>Select category</option>";
                foreach ($controller->listAllCategories() as $row){
                    echo "<option>".$row["Name"]."</option>";
                } echo "</select>"."<br><br>";
                echo "<select name='colors' id='colors'>";
                echo "<option value=''>Select color</option>";
                foreach ($controller->listAllColors() as $row){
                    echo "<option>".$row["Name"]."</option>";
                } echo "</select>"."<br><br>";
                echo "<textarea name='description' rows='4' placeholder='Description'></textarea><br><br>";
                echo "<input type='text' id='new-price' name='new-price' placeholder='Price'><br><br>";
                echo "<label for='balance'><b>Quantity: </b></label>";
                echo "<input type='number' id='balance' name='balance' placeholder='0' min='1' max='100'><br><br>";
                echo "<input type='submit' name='submit-product' value='Execute'>";
            echo "</form>";
            echo $val = addNewProductToDB();
?>