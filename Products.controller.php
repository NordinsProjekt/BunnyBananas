<?php

//Här ska all kontroll av data mellan browern och databasen ske

require_once('Products.model.php');

class ProductController
{
    function __destruct(){

    }

    function listAllProducts() //Visar alla produkter oavsett status
    {
        $model = new ProductDB();
        return $model->getAllProducts();
    }

    function listProducts($status) //$status kollar om produkten finns i sortimentet genom discontinued = 0 eller 1
    {
        $model = new ProductDB();
        return $model->getProducts($status);
    }

    function listProduct($productID) //Hämtar produktrad baserat på ID
    {
        $model = new ProductDB();
        $arr = $model->getProduct($productID);
        return $arr;
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
        $input = $this->checkUserInput($category, $arr);
        $model->setCategoryDB($input);
    }

    function insertProduct($name, $category, $color, $description, $price, $balance)
    {
        $model = new ProductDB();

        if ($name == "" || $category == "" || $color == "" || $price <= 0) {
            return -1;
        }
        else {
            $colorID = $model->getColorID($color);
            $categoryID = $model->getCategoryID($category);
            $model->setNewProductDB($name, $categoryID, $colorID, $description, $price, $balance);
        }
    }

    function insertUpdatedProduct($id, $name, $category, $color, $description, $price, $balance, $discontinued)
    {
        $model = new ProductDB();
        $colorID = $model->getColorID($color);
        $categoryID = $model->getCategoryID($category);
        $model->updateProductDB($id, $name, $categoryID, $colorID, $description, $price, $balance, $discontinued);
    }

    function removeColor($colorName){
        $model = new ProductDB();
        
        if ($colorName == "") {
            return -1;
        }
        else {
            $colorID = $model->getColorID($colorName);
            $model->deleteColor($colorID);
        }
    }

    function removeCategory($categoryName){
        $model = new ProductDB();

        if ($categoryName == "") {
            return -1;
        }
        else {
            $categoryID = $model->getCategoryID($categoryName);
            $model->deleteCategory($categoryID);
        }
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
        $input = $this->washInput($input);
        $temp = "";
        if ($input == NULL || $input == "") {
            return $msg = "Insertion failed: Invalid input!";
            return $input;
        }
        else{
            for ($i=0; $i<count($arr); $i++){ 
                $temp = $arr[$i]['Name'];
                if ($input == $temp) {
                    return $msg = "Insertion failed: Input already exists in DB!";
                    break;
                }
            }
            //Check if input not already exists
            if ($input != $temp) {
                return $input;
            } else{
                return $msg = "ERROR! Something went wrong with the insertion.";
            }
        }
    }



    function listSimilarProducts($limit, $categoryID, $excludePID)
    {
        $model = new ProductDB();
        return $model->getSimilarProducts($limit, $categoryID, $excludePID);
    }


    function listLookedAtProducts($limit, $excludePID)
    {
        $model = new ProductDB();
        return $model->getLookedAtProducts($limit, $excludePID);
    }

    function listSearchedProducts(){
        
        $model = new ProductDB();

        if (isset($_GET['category']) && isset($_GET['color'])) { //KATEGORI OCH COLOR
            return $model->GetSearchedProductsAllCriterias($_GET['searchCriteria'], $_GET['category'], $_GET['color']);    
        }
        elseif (isset($_GET['category']) && !isset($_GET['color'])) { //BARA KATEGORI
            return $model->GetSearchedProductsCategorys($_GET['searchCriteria'], $_GET['category']);
        }
        elseif (!isset($_GET['category']) && isset($_GET['color'])) { //BARA COLOR
            return $model->GetSearchedProductsColor($_GET['searchCriteria'], $_GET['color']);
        }
        elseif ($_GET['searchCriteria']) {
            return $model->GetSearchedProducts($_GET['searchCriteria']);
        }
        else //UTAN FILTER
        {
            return $model->getAllProducts();
        }
        
    }
}




?>