<?php

require_once('Products.model.php');

class ProductController
{
    function __destruct(){

    }

    function listAllColors()
    {
        $model = new ProductDB();
        $arr = $model->getAllColors();

        echo "<h2>Colors</h2>";
        echo "<table>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Name</th>";
            echo "</tr>";

        foreach ($arr as $row)
        {
            echo "<tr>";
                echo "<td>" . $row["ID"]. "</td>";
                echo "<td>" . $row["Name"]. "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    function listAllCategories()
    {
        $model = new ProductDB();
        $arr = $model->getAllCategories();

        echo "<h2>Categories</h2>";
        echo "<table>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Name</th>";
            echo "</tr>";

        foreach ($arr as $row)
        {
            echo "<tr>";
                echo "<td>" . $row["ID"]. "</td>";
                echo "<td>" . $row["Name"]. "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    function listAllProducts()
    {
        $model = new ProductDB();
        $arr = $model->getAllProducts();

        echo "<h2>Products</h2>";
        echo "<table>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Category</th>";
                echo "<th>Name</th>";
                echo "<th>Price</th>";
                echo "<th>Balance</th>";
                echo "<th>Discontinued</th>";
            echo "</tr>";

        foreach ($arr as $row) //same as ($model->getAllProducts() as $row)
        {
            echo "<tr>";
                echo "<td>" . $row["ID"]. "</td>";
                echo "<td>" . $row["Category"]. "</td>";
                echo "<td>" . $row["Name"]. "</td>";
                echo "<td>" . $row["Price"]. "</td>";
                echo "<td>" . $row["Balance"]. "</td>";
                echo "<td>" . $row["Discontinued"]. "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    function listProduct(){
        
    }

    function insertColor($color)
    {
        $model = new ProductDB();
        echo "Input: ".$color." [UNWASHED]"."<br>";
        echo "Input: ".$this->washInput($color)." [WASHED]";
        echo "<br>"."-------------------"."<br>";
        echo $this->checkUserInput($color);
        echo "<br>"."<br>"."<br>";
        $input = $this->checkUserInput($color);
        // //$model->setColorDB($input);
    }

    function insertCategory($category)
    {
        $model = new ProductDB();
        echo "Input: ".$category." [UNWASHED]"."<br>";
        echo "Input: ".$this->washInput($category)." [WASHED]";
        echo "<br>"."-------------------"."<br>";
        echo $this->checkUserInput($category);
        echo "<br>"."<br>"."<br>";
        $input = $this->checkUserInput($category);
        //$model->setCategoryDB($input);
    }

    function washInput($input) //"Tvätta" användarinput på specialtecken och mellanslag. Ska returnera den tvättade inputen!
    {
        $input = htmlspecialchars($input, ENT_QUOTES);
        $input = trim($input, " ");
        $banlist = array(".",";"," ","/",",","<",">",")","(","=","[","]","-","*");
        $safeInput = str_replace($banlist,"",$input);
        return ucfirst($safeInput); //Capitalize first letter
        
    }

    function checkUserInput($input)
    {
        $model = new ProductDB();
        $arr = $model->getAllColors();
        $input = $this->washInput($input);
        $clr = "";
        if ($input == NULL || $input == "") 
        {
            return $msg = "Insertion failed: Invalid input!";
        }
        else
        {
            for ($i=0; $i<count($arr); $i++)
            { 
                $clr = $arr[$i]['Name'];
                
                if ($input == $clr) 
                {
                    return $msg = "Insertion failed: Input already exists in DB!";
                    break;
                }

            }
            if ($input != $clr) //Check if input not already exists
            {
                return $input;
            }
            else
            {
                return $msg = "ERROR! Something went wrong with the insertion.";
                
            }
        }
    }

}




?>