<?php

//Här ska all kommunikation med databasen ske

require_once('classes/PDOHandler.class.php');

class ProductDB extends PDOHandler
{
    function __destruct(){

    }

    function getAllColors()
    {
        $stmt = $this->Connect()->prepare("SELECT * FROM `colors`;");
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }

    function getAllCategories()
    {
        $stmt = $this->Connect()->prepare("SELECT * FROM `categories`;");
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }

    function getAllProducts()
    {
        $query = "SELECT pr.ID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Price, pr.Balance, pr.Discontinued
        FROM `products` AS pr INNER JOIN categories AS ca ON pr.CategoryID = ca.ID
        INNER JOIN colors AS co ON pr.ColorID = co.ID;";
        //$stmt = $this->Connect()->prepare("SELECT pr.ID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Price, pr.Balance, pr.Discontinued FROM `products` AS pr INNER JOIN categories AS ca ON pr.CategoryID = ca.ID INNER JOIN colors AS co ON pr.ColorID = co.ID;");
        $stmt = $this->Connect()->prepare($query);
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }

    function getProduct($categoryName)
    {
        $stmt = $this->Connect()->prepare("SELECT pr.ID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Price, pr.Discontinued 
        FROM `products` AS pr INNER JOIN categories AS ca ON pr.CategoryID = ca.ID 
        INNER JOIN colors AS co ON pr.ColorID = co.ID WHERE ca.Name = ':name';");
        
        $stmt->bindParam(':name', $categoryName);
        $stmt->execute();
        return $result = $stmt->fetchAll();
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

}





?>