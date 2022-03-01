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

    function listProduct()
    {

    }

    function listAllColors()
    {
        $model = new ProductDB();
        return $model->getAllColors();
    }

    function listAllCategories()
    {
        $model = new ProductDB();
        return $model->getAllCategories();
    }

    function insertColor($color)
    {
        $model = new ProductDB();
        $arr = $model->getAllColors();
        $input = $this->checkUserInput($color, $arr);
        $model->setColorDB($input);
    }

    function insertCategory($category)
    {
        $model = new ProductDB();
        $arr = $model->getAllCategories();
        // echo "Input: ".$category." [UNWASHED]"."<br>";
        // echo "Input: ".$this->washInput($category)." [WASHED]";
        // echo "<br>"."-------------------"."<br>";
        // echo $this->checkUserInput($category, $arr);
        // echo "<br>"."<br>"."<br>";
        $input = $this->checkUserInput($category, $arr);
        $model->setCategoryDB($input);
    }

    function insertProduct($name, $category, $color, $description, $price, $balance)
    {
        $model = new ProductDB();
        $colorID = $model->getColorID($color);
        $categoryID = $model->getCategoryID($category);
        $model->setNewProductDB($name, $categoryID, $colorID, $description, $price, $balance);
        
        //Lägg till inputhantering!
        // -Allt måste vara ifyllt?
        // -Namn [OK]
        // -Category [not null]
        // -Color [not null]
        // -Description [OK med null/tom?]
        // -Price [is_numeric($price)] Måste vara siffor! Maxvärde?

        // if ($balance >= 0 || $balance <= 100 || is_numeric($price))
        // {
        // }
        // else {
        //     //$msg = "Description can't be NULL and balance must be between 0-100."."<br>"."Please try again!";
        //     $msg = "Oops, something went wrong";
        // }
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
            return $msg = "Insertion failed: Invalid input!";
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