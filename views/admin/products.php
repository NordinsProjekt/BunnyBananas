<?php
$controller = new ProductController();
echo "<div class='AdminProducts'>";
            echo "<details><summary>Add New Product</summary>";
            echo "<section class ='ProductSection' id='AddNewProduct'>";
            echo "<h3>Add new product</h3>";
            echo "<form action='#' method='post'>";
                echo "<input type='text' id='new-product' name='new-product' placeholder='Product name'><br>";
                echo "<select name='categories' id='categories'>";
                echo "<option value=''>Select category</option>";
                foreach ($controller->listAllCategories() as $row){
                    echo "<option>".$row["Name"]."</option>";
                } echo "</select>"."<br>";
                echo "<select name='colors' id='colors'>";
                echo "<option value=''>Select color</option>";
                foreach ($controller->listAllColors() as $row){
                    echo "<option>".$row["Name"]."</option>";
                } echo "</select>"."<br>";
                echo "<textarea name='description' rows='4' placeholder='Description'></textarea><br>";
                echo "<input type='text' id='new-price' name='new-price' placeholder='Price'><br>";
                echo "<label for='balance'><b>Quantity: </b></label>";
                echo "<input type='number' id='balance' name='balance' placeholder='0' min='1' max='100'><br>";
                echo "<input type='submit' name='submit-product' value='Execute'>";
            echo "</form>";
            echo "</section>";
            echo "</details>";
            
            echo "<details><summary>Add New Color</summary>";
            echo "<section class ='ProductSection' id='AddNewColor'>";
            echo "<h3>Add new color</h3>";
            echo "<form action='#' method='post'>";
                //echo "<label for='new-color'><b>Add new color</b></label><br>";
                echo "<input type='text' id='new-color' name='new-color' placeholder='Color'>";
                echo "<input type='submit' name='submit-color' value='Execute'>";
            echo "</form>";
            echo "</section>";
            echo "</details>";

            echo "<details><summary>Add New Category</summary>";
            echo "<section class ='ProductSection' id='NewCategory'>";
            echo "<h3>Add new category</h3>";
            echo "<form action='#' method='post'>";
                //echo "<label for='new-category'><b>Add new category</b></label><br>";
                echo "<input type='text' id='new-category' name='new-category' placeholder='Category'>";
                echo "<input type='submit' name='submit-category' value='Execute'>";
            echo "</form>";
            echo "</section>";
            echo "</details>";
    echo "</div>";
?>