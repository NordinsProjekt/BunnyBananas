<?php
$controller = new ProductController();
echo "<div class='AdminProducts'>";
            echo "<details><summary>Skapa ny produkt</summary>";
            echo "<section class ='ProductSection' id='AddNewProduct'>";
            echo "<h3 class='TitelHeader'>Skapa Produkt</h3>";
            echo "<form action='#' method='post'>";
                echo "<input type='text' id='new-product' name='new-product' placeholder='Produkt Namn'><br>";
                echo "<select name='categories' id='categories'>";
                echo "<option value=''>Välj Kategori</option>";
                foreach ($controller->listAllCategories() as $row){
                    echo "<option>".$row["Name"]."</option>";
                } echo "</select>"."<br>";
                echo "<select name='colors' id='colors'>";
                echo "<option value=''>Välj Färg</option>";
                foreach ($controller->listAllColors() as $row){
                    echo "<option>".$row["Name"]."</option>";
                } echo "</select>"."<br>";
                echo "<textarea name='description' rows='4' placeholder='Beskrivning'></textarea><br>";
                echo "<input type='text' id='new-price' name='new-price' placeholder='Pris'><br>";
                echo "<label for='balance'><b>Antal: </b></label>";
                echo "<input type='number' id='balance' name='balance' placeholder='0' min='1' max='100'><br>";
                echo "<input type='submit' name='submit-product' value='Skapa'>";
            echo "</form>";
            echo "</section>";
            echo "</details>";
            
            echo "<details><summary>Skapa ny färg</summary>";
            echo "<section class ='ProductSection' id='AddNewColor'>";
            echo "<h3 class='TitelHeader'>Lägg till färg</h3>";
            echo "<form action='#' method='post'>";
                //echo "<label for='new-color'><b>Add new color</b></label><br>";
                echo "<input type='text' id='new-color' name='new-color' placeholder='Färg'>";
                echo "<input type='submit' name='submit-color' value='Skapa'>";
            echo "</form>";
            echo "</section>";
            echo "</details>";

            echo "<details><summary>Skapa ny kategori</summary>";
            echo "<section class ='ProductSection' id='NewCategory'>";
            echo "<h3 class='TitelHeader'>Skapa ny kategori</h3>";
            echo "<form action='#' method='post'>";
                //echo "<label for='new-category'><b>Add new category</b></label><br>";
                echo "<input type='text' id='new-category' name='new-category' placeholder='Kategori'>";
                echo "<input type='submit' name='submit-category' value='Skapa'>";
            echo "</form>";
            echo "</section>";
            echo "</details>";
    echo "</div>";
?>