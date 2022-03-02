<?php
$controller = new ProductController();
echo "<div class='AdminProducts'>";
            echo "<details><summary>Skapa ny produkt</summary>";
            echo "<section class ='ProductSection' id='AddNewProduct'>";
            echo "<h3 class='TitelHeader'>Skapa Produkt</h3>";
            echo "<form action='#' method='post'>";
                echo "<input type='text' id='new-product' name='new-product' placeholder='Produktnamn' required><br>";
                echo "<select name='categories' id='categories' required>";
                echo "<option value=''>Välj Kategori</option>";
                foreach ($controller->listAllCategories() as $row){
                    echo "<option>".$row["Name"]."</option>";
                } echo "</select>"."<br>";
                echo "<select name='colors' id='colors' required>";
                echo "<option value=''>Välj Färg</option>";
                foreach ($controller->listAllColors() as $row){
                    echo "<option>".$row["Name"]."</option>";
                } echo "</select>"."<br>";
                echo "<textarea name='description' rows='4' placeholder='Beskrivning'></textarea><br>";
                echo "<input type='text' id='new-price' name='new-price' placeholder='Pris' required><br>";
                echo "<label for='balance'><b>Antal: </b></label>";
                echo "<input type='number' id='balance' name='balance' placeholder='0' min='1' max='100'><br>";
                echo "<input type='submit' name='submit-product' value='Skapa'>";
            echo "</form>";
            echo "</section>";
            echo "</details>";
            
            echo "<details><summary>Hantera färg</summary>";
            echo "<section class ='ProductSection' id='AddNewColor'>";
            echo "<h3 class='TitelHeader'>Lägg till färg</h3>";
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
            echo "<h3 class='TitelHeader'>Skapa ny kategori</h3>";
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
<details>
    <summary>Visa alla produkter</summary>
    <table>
        <tr>
            <th>Produkt ID</th>
            <th>Kategori</th>
            <th>Namn</th>
            <th>Pris</th>
            <th>Antal</th>
            <th>I lager</th>
        </tr>
        <?php foreach ($controller->listAllProducts() as $row){?>
        <tr>
            <td><?php echo $row["ID"]?></td>
            <td><?php echo $row["Category"]?></td>
            <td><?php echo $row["Name"]?></td>
            <td><?php echo $row["Price"]?></td>
            <td><?php echo $row["Balance"]?></td>
            <td><?php echo $row["Discontinued"]?></td>
        </tr>
        <?php }?>
    </table>
</details>
<details>
    <summary>Visa alla aktiva produkter</summary>
    <table>
        <tr>
            <th>Produkt ID</th>
            <th>Kategori</th>
            <th>Namn</th>
            <th>Pris</th>
            <th>Antal</th>
            <th>I lager</th>
        </tr>
        <?php foreach ($controller->listProducts($status=0) as $row){?>
        <tr>
            <td><?php echo $row["ID"]?></td>
            <td><?php echo $row["Category"]?></td>
            <td><?php echo $row["Name"]?></td>
            <td><?php echo $row["Price"]?></td>
            <td><?php echo $row["Balance"]?></td>
            <td><?php echo $row["Discontinued"]?></td>
        </tr>
        <?php }?>
    </table>
</details>
<details>
<summary>Editera produkt</summary>
<p>För att editera en produkt, klicka på dess ID-nummer.</p>
<table>
        <tr>
            <th>ID</th>
            <th>Kategori</th>
            <th>Namn</th>
            <th>Färg</th>
            <th>Pris</th>
            <th>Beskrivning</th>
            <th>Antal</th>
            <th>I lager</th>
        </tr>
        <?php foreach ($controller->listAllProducts() as $row){?>
        <tr>
            <td><a href="?admin=products&productID=<?php echo $row['ID']?>"><?php echo $row['ID']?></a></td>
            <td><?php echo $row["Category"]?></td>
            <td><?php echo $row["Name"]?></td>
            <td><?php echo $row["Color"]?></td>
            <td><?php echo $row["Price"]?></td>
            <td><?php echo $row["Description"]?></td>
            <td><?php echo $row["Balance"]?></td>
            <td><?php echo $row["Discontinued"]?></td>
        </tr>
        <?php }?>
    </table>
</details>

<?php
    if (isset($_GET['productID']))
    {
        $value = $controller->listProduct($_GET['productID']);
            echo "<div class='EditProduct'>";
            echo "<h3 class='TitelHeader'>Editera produkt</h3>";
            echo "<form method='post' enctype='multipart/form-data'>";
            echo "<label for='productName'>Produktnamn</label><br>";
                echo "<input type='text' id='productName' name='productName' value='".$value['Name']."'><br>";

                echo "<label for='categories'>Kategori</label>";
                echo "<select name='categories' id='categories'>";
                echo "<option value='".$value['Category']."'>".$value['Category']."</option>";
                foreach ($controller->listAllCategories() as $row){
                    echo "<option>".$row["Name"]."</option>"; //Hur tar jag bort dubbla värden?
                } echo "</select>"."<br>";

                echo "<label for='colors'>Färg</label>";
                echo "<select name='colors' id='colors'>";
                echo "<option value='".$value['Color']."'>".$value['Color']."</option>"; //Visar ej färg
                foreach ($controller->listAllColors() as $row){
                    echo "<option>".$row["Name"]."</option>";
                } echo "</select>"."<br>";

                echo "<label for='description'>Beskrivning</label><br>";
                echo "<textarea name='description' rows='4'>".$value['Description']."</textarea><br><br>";

                echo "<label for='description'><b>Pris</b></label><br>";
                echo "<input type='text' id='update-price' name='update-price' value='".$value['Price']."'><br>";

                echo "<label for='balance'>Antal</label>";
                echo "<input type='number' id='balance' name='balance' value='".$value['Balance']."' min='1' max='100'><br>";

                echo "<label for='discontinued'>I lager?</label>";
                echo "<input type='number' id='discontinued' name='discontinued' value='".$value['Discontinued']."' min='0' max='1'>";
                echo " 0 = Active product, 1 = Discontinued"."<br>";
                echo "<input type='hidden' name='productID' value='".$_GET['productID']."'>";
                echo "<label for='uploadfile'>Lägg till bild</label>";
                echo "<input type='file' name='fileToUpload' value='' /><br>";
                echo "<input type='submit' name='update-product' value='Spara'>";
            echo "</form></div>";
        }
?>