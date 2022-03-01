<?php $controller = new ProductController();?>

<a href="products"><h2>Products</h2></a>
<!-- <h3>All products:</h3> -->

    <table>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Name</th>
            <th>Color</th>
            <th>Price</th>
            <th>Description</th>
            <th>Balance</th>
            <th>Discontinued</th>
        </tr>
        <?php foreach ($controller->listAllProducts() as $row){?>
        <tr>
            <td><a href="?productID=<?php echo $row['ID']?>"><?php echo $row['ID']?></a></td>
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

<br>

<?php
    if (isset($_GET['productID'])){
        foreach($controller->listProduct($_GET['productID']) as $value){
            echo "<h3>Change product</h3>";
            echo "<form action='#' method='post'>";
            echo "<label for='productName'>Product name</label><br>";
                echo "<input type='text' id='productName' name='productName' value='".$value['Name']."'><br><br>";

                echo "<select name='categories' id='categories'>";
                echo "<option value='".$value['Category']."'>".$value['Category']."</option>";
                foreach ($controller->listAllCategories() as $row){
                    echo "<option>".$row["Name"]."</option>"; //Hur tar jag bort dubbla värden?
                } echo "</select>"."<br><br>";

                echo "<select name='colors' id='colors'>";
                echo "<option value='".$value['Color']."'>".$value['Color']."</option>"; //Visar ej färg
                foreach ($controller->listAllColors() as $row){
                    echo "<option>".$row["Name"]."</option>";
                } echo "</select>"."<br><br>";

                echo "<textarea name='description' rows='4'>".$value['Description']."</textarea><br><br>";

                echo "<input type='text' id='update-price' name='update-price' value='".$value['Price']."'><br><br>";

                echo "<label for='balance'><b>Quantity: </b></label>";
                echo "<input type='number' id='balance' name='balance' value='".$value['Balance']."' min='1' max='100'><br><br>";

                echo "<label for='discontinued'><b>In stock? </b></label>";
                echo "<input type='number' id='discontinued' name='discontinued' value='".$value['Discontinued']."' min='0' max='1'>";
                echo " 0 = Active product, 1 = Discontinued"."<br><br>";

                echo "<input type='submit' name='update-product' value='Run changes'>";
            echo "</form>";
            echo $val = updateProductInDB($_GET['productID']);
        }
    }
    
    ?>
    <!-- <label for="fname">Förnamn:</label><br>
    <input type="text" id="fname" name="txtFirstname" value="<?php echo $row['Firstname']; ?>"><br> -->

<br><br>


<br>
<details>
    <summary>View all available products</summary>
    <table>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Name</th>
            <th>Price</th>
            <th>Balance</th>
            <th>Discontinued</th>
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
<br>
<details>
    <summary>View all discountinued products</summary>
    <table>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Name</th>
            <th>Price</th>
            <th>Balance</th>
            <th>Discontinued</th>
        </tr>
        <?php foreach ($controller->listProducts($status=1) as $row){?>
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


<h3>What do you want to do?</h3>

<ul style="list-style: none">
    <li><a href="?module=newProduct">Create new product [DONE]</a></li>
    <li><a href="?module=newColor">Add new color [DONE]</a></li>
    <li><a href="?module=newCategory">Add new category [DONE]</a></li>
    <!-- <li><a href="?module=updateProduct">Change product</a></li> -->
    <li><a href="?module=discontinueProduct">Discontinue product</a></li>
</ul>


<?php

if (isset($_GET['module']))
{
   switch ($_GET['module'])
   {
       case 'newProduct':
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
                //Lägg till bild
                echo "<input type='submit' name='submit-product' value='Execute'>";
            echo "</form>";
            echo $val = addNewProductToDB();
            break;

        case 'newColor':
            echo "<h3>Add new color</h3>";
            echo "<form action='#' method='post'>";
                //echo "<label for='new-color'><b>Add new color</b></label><br>";
                echo "<input type='text' id='new-color' name='new-color' placeholder='Color'>";
                echo "<input type='submit' name='submit-color' value='Execute'>";
            echo "</form>";
            echo $val = addNewColorToDB();
            break;

        case 'newCategory':
            echo "<h3>Add new category</h3>";
            echo "<form action='#' method='post'>";
                //echo "<label for='new-category'><b>Add new category</b></label><br>";
                echo "<input type='text' id='new-category' name='new-category' placeholder='Category'>";
                echo "<input type='submit' name='submit-category' value='Execute'>";
            echo "</form>";
            echo $val = addNewCategoryToDB();
            break;

        case 'discontinueProduct':
            echo "<h3>Discountinue product</h3>";
            //echo "<li><a href='#'>Choose category</a></li>";
            echo "<label for='balance'><b>ID: </b></label>";
                echo "<input type='number' id='balance' name='balance' placeholder='0' min='1' max='100'><br><br>";
                echo "<input type='submit' name='submit-product' value='Execute'>";
            echo "<br>";
            //echo "Checkbox for security";
            break;

       default:
           # code...
           break;
    
    }
}

function addNewProductToDB()
{
    $controller = new ProductController();
    $name = "";
    $category = "";
    $color = "";
    $description = "";
    $price = "";
    $balance = "";

    if (isset($_POST['submit-product']))
    {
        echo "---INSIDE View---"."<br>";
        if (isset($_POST['new-product']))
        {
            $name = $_POST['new-product'];
            echo "Name: $name";
            echo "<br>";
        }
        if (isset($_POST['categories']))
        {
            $category = $_POST['categories'];
            echo "Category: $category";
            echo "<br>";
        }
        if (isset($_POST['colors']))
        {
            $color = $_POST['colors'];
            echo "Color: $color";
            echo "<br>";
        }
        if (isset($_POST['description']))
        {
            $description = $_POST['description'];
            echo "Desc: $description";
            echo "<br>";
        }
        if (isset($_POST['new-price']))
        {
            $price = $_POST['new-price'];
            echo "Price: $price";
            echo "<br>";
        }
        if (isset($_POST['balance']))
        {
            $balance = $_POST['balance'];
            echo "Balance: $balance";
            echo "<br>";
        }
        else {
            echo "Incorrect input!";
        }
        $controller->insertProduct($name, $category, $color, $description, $price, $balance);
    }
}


function updateProductInDB($productID)
{
    $controller = new ProductController();
    $id = $productID;
    $name = "";
    $category = "";
    $color = "";
    $description = "";
    $price = "";
    $balance = "";
    $discontined = "";

    if (isset($_POST['update-product']))
    {
        echo "---INSIDE View---"."<br>";
        echo "ID: $id"."<br>";
        if (isset($_POST['productName']))
        {
            $name = $_POST['productName'];
            echo "Name: $name";
            echo "<br>";
        }
        if (isset($_POST['categories']))
        {
            $category = $_POST['categories'];
            echo "Category: $category";
            echo "<br>";
        }
        if (isset($_POST['colors']))
        {
            $color = $_POST['colors'];
            echo "Color: $color";
            echo "<br>";
        }
        if (isset($_POST['description']))
        {
            $description = $_POST['description'];
            echo "Desc: $description";
            echo "<br>";
        }
        if (isset($_POST['update-price']))
        {
            $price = $_POST['update-price'];
            echo "Price: $price";
            echo "<br>";
        }
        if (isset($_POST['balance']))
        {
            $balance = $_POST['balance'];
            echo "Balance: $balance";
            echo "<br>";
        }
        if (isset($_POST['discontinued']))
        {
            $discontined = $_POST['discontinued'];
            echo "Discontinued: $discontined";
            echo "<br>";
        }
        else {
            echo "Incorrect input!";
        }
        $controller->insertUpdatedProduct($id, $name, $category, $color, $description, $price, $balance, $discontined);
    }
}

function addNewColorToDB()
{
    $controller = new ProductController();
    $color = "";
    if (isset($_POST['submit-color']))
    {
        if (isset($_POST['new-color']))
        {
            $color = ($_POST['new-color']);
            $controller->insertColor($color);
        }
    }
}

function addNewCategoryToDB()
{
    $controller = new ProductController();
    $category = "";
    if (isset($_POST['submit-category']))
    {
        if (isset($_POST['new-category']))
        {
            $category = ($_POST['new-category']);
            $controller->insertCategory($category);
        }
    }


}

    function changeProduct(){

    }

    function discontinueProduct(){

    }

?>




