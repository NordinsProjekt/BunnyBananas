<?php

require_once('Products.model.php');

class ProductController
{
    function __destruct(){

    }

    function listAllProducts()
    {
        $model = new ProductDB();
        return $model->getAllProducts();
    }

    function listAllColors()
    {
        $model = new ProductDB();
        return $model->getAllColors();

        // echo "<h2>Colors</h2>";
        // echo "<table>";
        //     echo "<tr>";
        //         echo "<th>ID</th>";
        //         echo "<th>Name</th>";
        //     echo "</tr>";

        // foreach ($arr as $row)
        // {
        //     echo "<tr>";
        //         echo "<td>" . $row["ID"]. "</td>";
        //         echo "<td>" . $row["Name"]. "</td>";
        //     echo "</tr>";
        // }
        // echo "</table>";
    }

    function listAllCategories()
    {
        $model = new ProductDB();
        return $model->getAllCategories();
    }

    function listProduct()
    {

    }

    function insertColor($color)
    {
        $model = new ProductDB();
        $arr = $model->getAllColors();
        echo "Input: ".$color." [UNWASHED]"."<br>";
        echo "Input: ".$this->washInput($color)." [WASHED]";
        echo "<br>"."-------------------"."<br>";
        echo $this->checkUserInput($color, $arr);
        echo "<br>"."<br>"."<br>";
        $input = $this->checkUserInput($color, $arr);
        //$model->setColorDB($input);
    }

    function insertCategory($category)
    {
        $model = new ProductDB();
        $arr = $model->getAllCategories();
        echo "Input: ".$category." [UNWASHED]"."<br>";
        echo "Input: ".$this->washInput($category)." [WASHED]";
        echo "<br>"."-------------------"."<br>";
        echo $this->checkUserInput($category, $arr);
        echo "<br>"."<br>"."<br>";
        $input = $this->checkUserInput($category, $arr);
        //$model->setCategoryDB($input);
    }

    function washInput($input) //"Tvätta" användarinput på specialtecken och mellanslag. Ska returnera den tvättade inputen!
    {
        $input = htmlspecialchars($input, ENT_QUOTES);
        $input = trim($input, " ");
        $input = preg_replace('/[0-9]+/', '', $input);
        $banlist = array(".",";"," ","/",",","<",">",")","(","=","[","]","-","*","%","!","#","?","&");
        $safeInput = str_replace($banlist,"",$input);
        return ucfirst($safeInput); //Capitalize first letter
        
    }

    function checkUserInput($input, $arr)
    {
        $model = new ProductDB();
        //$arr = $model->getAllColors();
        $input = $this->washInput($input);
        $clr = "";
        if ($input == NULL || $input == "") {
            //return $msg = "Insertion failed: Invalid input!";
            return $input;
        }
        else{
            for ($i=0; $i<count($arr); $i++){ 
                $clr = $arr[$i]['Name'];
                if ($input == $clr) {
                    return $msg = "Insertion failed: Input already exists in DB!";
                    break;
                }
            }
            //Check if input not already exists
            if ($input != $clr) {
                return $input;
            } else{
                return $msg = "ERROR! Something went wrong with the insertion.";
            }
        }
    }



}




?>