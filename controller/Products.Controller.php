<?php

//Här ska all kontroll av data mellan browern och databasen ske

require_once('model/Products.Model.php');

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

        if ($input == -1) {
            $_SESSION['Message'] = "Insertion failed: Invalid color input!";
        }
        elseif ($input == -2) {
            $_SESSION['Message'] = "Insertion failed: Color already exists in DB!";
        }
        else{
            try {
                $model->setColorDB($input);
                $_SESSION['Message'] = "SUCCESS: New color added in DB!";
            } catch (\Throwable $t) {
                $_SESSION['Message'] = $t->getMessage();
            }
        }
    }

    function insertCategory($category)
    {
        $model = new ProductDB();
        $arr = $model->getAllCategories();
        $input = $this->checkUserInput($category, $arr);

        if ($input == -1) {
            $_SESSION['Message'] = "Insertion failed: Invalid category input!";
        }
        elseif ($input == -2) {
            $_SESSION['Message'] = "Insertion failed: Category already exists in DB!";
        }
        else{
            try {
                $model->setCategoryDB($input);
                $_SESSION['Message'] = "SUCCESS: New category added in DB!";
            } catch (\Throwable $t) {
                $_SESSION['Message'] = $t->getMessage();
            }
        }

    }

    function insertProduct($name, $category, $color, $description, $price, $balance)
    {
        $model = new ProductDB();

        if ($name == "" || $category == "" || $color == "" || $price <= 0 || $price != is_numeric($price)) {
            $_SESSION['Message'] = "Insertion failed: Invalid input!<br>Make sure everything is filled in correctly.";
        }
        else {
            try
            {
                $colorID = $model->getColorID($color);
                $categoryID = $model->getCategoryID($category);
                $model->setNewProductDB($name, $categoryID, $colorID, $description, $price, $balance);
                $_SESSION['Message'] = "SUCCESS: New product added to DB!";
            }
            catch (\Throwable $t) {
                $_SESSION['Message'] = $t->getMessage();
            }
        }
    }

    function insertUpdatedProduct($id, $name, $category, $color, $description, $price, $balance, $discontinued)
    {
        $model = new ProductDB();

        if ($name == "" || $category == "" || $color == "" || $price <= 0 || $price != is_numeric($price)) {
            $_SESSION['Message'] = "Insertion failed: Invalid input!<br>Make sure everything is filled in correctly.";
        }
        else {
            try
            {
                $colorID = $model->getColorID($color);
                $categoryID = $model->getCategoryID($category);
                $model->updateProductDB($id, $name, $categoryID, $colorID, $description, $price, $balance, $discontinued);
                $_SESSION['Message'] = "SUCCESS: Product updated in DB!";
            }
            catch (\Throwable $t) {
                $_SESSION['Message'] = $t->getMessage();
            }
        }
    }

    function removeColor($colorName)
    {
        if ($colorName != "") 
        {
            $model = new ProductDB();
            try
            {
                $colorID = $model->getColorID($colorName);
                $model->deleteColor($colorID);
                $_SESSION['Message'] = "SUCCESS: Color deleted from DB!";
            }
            catch (\Throwable $t) {
                $_SESSION['Message'] = $t->getMessage();
            }
        }
        else
        {
            $_SESSION['Message'] = "Deletion failed: Invalid color input!";
        }
    }

    function removeCategory($categoryName)
    {
        if ($categoryName != "") 
        {
            $model = new ProductDB();
            try
            {
                $categoryID = $model->getCategoryID($categoryName);
                $model->deleteCategory($categoryID);
                $_SESSION['Message'] = "SUCCESS: Category deleted from DB!";
            }
            catch (\Throwable $t) {
                $_SESSION['Message'] = $t->getMessage();
            }
        }
        else
        {
            $_SESSION['Message'] = "Deletion failed: Invalid category input!";
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
        if ($input == NULL || $input == "")
        {
            return -1;
        }
        else
        {
            for ($i=0; $i<count($arr); $i++)
            { 
                $temp = $arr[$i]['Name'];
                if ($input == $temp)
                {
                    return -2;
                }
            }
            return $input;
            
        }
    }



    function listSimilarProducts($limit, $categoryID, $excludePID) //returnerar x-antal($limit) produkter som är av y-kategori
    {
        $model = new ProductDB();
        return $model->getSimilarProducts($limit, $categoryID, $excludePID);
    }


    function listLookedAtProducts($limit, $excludePID)  //returnerar x-antal($limit) randomisade produkter
    {
        $model = new ProductDB();
        return $model->getLookedAtProducts($limit, $excludePID);
    }

    function listSearchedProducts(){  //returnerar sökresultat
        
        $model = new ProductDB();

        //Väljer rätt funktion för sökningen beroende på sorteringsalternativ
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

    function updateCurrentBalance($productID, $inCart)
    {

        $model = new ProductDB();
        $arr = $model->getProduct($productID);
        $amount = $arr['Balance'];
        $productsLeft = $amount-$inCart;
        if ($productsLeft >= 0) {
            $model->updateBalance($productID, $productsLeft);
        }
        else{
            $_SESSION['Message'] = "FELMEDDELANDE: Kan ej köpa fler antal än det finns i lager!";
        }
    }

}




?>