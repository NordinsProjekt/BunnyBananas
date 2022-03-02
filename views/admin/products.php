<?php
$controller = new ProductController();
echo "<div class='AdminProducts'>";
            echo "<details><summary>Skapa ny produkt</summary>";
            echo "<section class ='ProductSection' id='AddNewProduct'>";
            echo "<h3>Skapa Produkt</h3>"; //Skapa produkt
            echo "<form action='#' method='post'>";
                echo "<input type='text' id='new-product' name='new-product' placeholder='Produktnamn'><br>";
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
            
            echo "<details><summary>Hantera färg</summary>";
            echo "<section class ='ProductSection' id='AddNewColor'>";
            echo "<h3>Lägg till färg</h3>"; //Lägg till färg
            echo "<form action='#' method='post'>";
                echo "<input type='text' id='new-color' name='new-color' placeholder='Färg'>";
                echo "<input type='submit' name='submit-color' value='Skapa'>";
            echo "</form>";
            echo "</section>";
            echo "<br>";
            echo "<section class ='ProductSection' id='DeleteColor'>";
            echo "<h3>Radera färg</h3>"; //Radera färg
            echo "<form action='#' method='post'>";
                echo "<label for='color'><b>Färg: </b></label>";
                echo "<select name='color' id='color'>";
                echo "<option value='".$value['Color']."'>".$value['Color']."</option>";
                foreach ($controller->listAllColors() as $row){
                    echo "<option>".$row["Name"]."</option>";
                } echo "</select>";
                echo "<input type='submit' name='delete-color' value='Delete'>";
            echo "</form>";
            echo "</section>";
            echo "</details>";

            echo "<details><summary>Hantera kategori</summary>";
            echo "<section class ='ProductSection' id='NewCategory'>";
            echo "<h3>Skapa ny kategori</h3>"; //Skapa ny kategori
            echo "<form action='#' method='post'>";
                echo "<input type='text' id='new-category' name='new-category' placeholder='Kategori'>";
                echo "<input type='submit' name='submit-category' value='Skapa'>";
            echo "</form>";
            echo "</section>";
            echo "<br>";
            echo "<section class ='ProductSection' id='DeleteCategory'>";
            echo "<h3>Radera kategori</h3>"; //Radera kategori
            echo "<form action='#' method='post'>";
                echo "<label for='category'><b>Kategori: </b></label>";
                echo "<select name='category' id='category'>";
                echo "<option value='".$value['Category']."'>".$value['Category']."</option>";
                foreach ($controller->listAllCategories() as $row){
                    echo "<option>".$row["Name"]."</option>";
                } echo "</select>";
                echo "<input type='submit' name='delete-category' value='Delete'>";
            echo "</form>";
            echo "</section>";
            echo "</details>";
    echo "</div>";
?>