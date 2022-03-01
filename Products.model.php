<?php

//Här ska all kommunikation med databasen ske

require_once('classes/PDOHandler.class.php');

class ProductDB extends PDOHandler
{
    function __destruct(){

    }

    function getAllColors()
    {
        $stmt = $this->Connect()->prepare("SELECT Name FROM `colors`;");
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }

    function getAllCategories()
    {
        $stmt = $this->Connect()->prepare("SELECT Name FROM `categories`;");
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }

    function getProducts($status)
    {
        $stmt = $this->Connect()->prepare("SELECT pr.ID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Price, pr.Balance, pr.Discontinued
        FROM `products` AS pr INNER JOIN categories AS ca ON pr.CategoryID = ca.ID
        INNER JOIN colors AS co ON pr.ColorID = co.ID WHERE pr.Discontinued = :status;");
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }

    function getAllProducts()
    {
        $stmt = $this->Connect()->prepare("SELECT pr.ID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Description, pr.Price, pr.Balance, pr.Discontinued
        FROM `products` AS pr INNER JOIN categories AS ca ON pr.CategoryID = ca.ID
        INNER JOIN colors AS co ON pr.ColorID = co.ID 
        ORDER BY pr.ID ASC;");
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }

    function getProduct($productID)
    {
        // $stmt = $this->Connect()->prepare("SELECT pr.ID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Price, pr.Discontinued 
        // FROM `products` AS pr INNER JOIN categories AS ca ON pr.CategoryID = ca.ID 
        // INNER JOIN colors AS co ON pr.ColorID = co.ID WHERE pr.ID = ':id';");

        $stmt = $this->Connect()->prepare("SELECT pr.ID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Price, pr.Description, 
        pr.Balance, pr.Discontinued FROM `products` AS pr 
        INNER JOIN categories AS ca ON pr.CategoryID = ca.ID 
        INNER JOIN colors AS co ON pr.ColorID = co.ID WHERE pr.ID = :id;");

        $stmt->bindParam(':id', $productID);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function setColorDB($color)
    {
        $stmt = $this->Connect()->prepare("INSERT INTO colors (Name) VALUES (:color);");
        $stmt->bindParam(':color', $color);
        $stmt->execute();
        echo $msg = "SUCCESS! New color added to DB!";
    }

    function setCategoryDB($category)
    {
        $stmt = $this->Connect()->prepare("INSERT INTO categories (Name) VALUES (:category);");
        $stmt->bindParam(":category", $category);
        $stmt->execute();
        echo $msg = "SUCCESS! New category added to DB!";
    }

    function setNewProductDB($name, $category, $color, $description, $price, $balance)
    {
        echo "------INSIDE DB------"."<br>";
        echo "Name: ".$name."<br>";
        echo "Category: ".$category."<br>";
        echo "Color: ".$color."<br>";
        echo "Desc: ".$description."<br>";
        echo "Price: ".$price."<br>";
        echo "Balance: ".$balance."<br>";
        echo "--------------------------"."<br>";
        
        $stmt = $this->Connect()->prepare("INSERT INTO products (Name, CategoryID, ColorID, Description, Price, Balance, Discontinued) 
        VALUES (:name, :category, :color, :description, :price, :balance, 0)"); //0 = När ny produkt skapas förutsätt det att den ska finnas med i sortimentet
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":color", $color);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":balance", $balance);
        $stmt->execute();
        echo $msg = "SUCCESS! New product added to DB!";
    }

    function updateProductDB($id, $name, $category, $color, $description, $price, $balance, $discontinued)
    {
        // $stmt = $this->Connect()->prepare("INSERT INTO products (Name, CategoryID, ColorID, Description, Price, Balance, Discontinued) 
        // VALUES (:name, :category, :color, :description, :price, :balance, :discontinued)");
        $stmt = $this->Connect()->prepare("UPDATE products SET Name=:name, CategoryID=:category,ColorID=:color,
        Description=:description,Price=:price,Balance=:balance,Discontinued=:discontinued WHERE ID=:id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":color", $color);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":balance", $balance);
        $stmt->bindParam(":discontinued", $discontinued);
        $stmt->execute();
        echo $msg = "SUCCESS! Product updated in DB!";
    }


    function getColorID($colorName)
    {
        //echo "---INSIDE Model---"."<br>";
        //echo "BEFORE Query: $colorName"."<br>";
        $stmt = $this->Connect()->prepare("SELECT ID FROM colors WHERE Name=:name;");
        $stmt->bindParam(":name", $colorName);
        $stmt->execute();
        $result = $stmt->fetch()['ID'];
        //echo "AFTER Query: ".$result;
        return $result;
    }

    function getCategoryID($categoryName)
    {
        $stmt = $this->Connect()->prepare("SELECT ID FROM categories WHERE Name=:name;");
        $stmt->bindParam(":name", $categoryName);
        $stmt->execute();
        $result = $stmt->fetch()['ID'];
        return $result;
    }

    function removeProduct(){

    }

    function updateProduct(){

    }



}





?>