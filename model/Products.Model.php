<?php

//Här ska all kommunikation med databasen ske

require_once('classes/PDOHandler.class.php');

class ProductDB extends PDOHandler
{
    function __destruct(){

    }

    function getAllProducts() //Hämtar alla produkter oavsett status
    {

        $stmt = $this->Connect()->prepare("SELECT pr.ID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Description, pr.Price, pr.Balance, pr.Discontinued
        FROM `products` AS pr INNER JOIN categories AS ca ON pr.CategoryID = ca.ID
        INNER JOIN colors AS co ON pr.ColorID = co.ID 
        ORDER BY pr.CategoryID ASC;");
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }


    function getProducts($status) //Hämtar alla produkter med angiven status (0 eller 1)
    {
        $stmt = $this->Connect()->prepare("SELECT pr.ID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Price, pr.Balance, pr.Discontinued
        FROM `products` AS pr INNER JOIN categories AS ca ON pr.CategoryID = ca.ID
        INNER JOIN colors AS co ON pr.ColorID = co.ID WHERE pr.Discontinued = :status
        ORDER BY pr.CategoryID ASC;");
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }

    function getProduct($productID) //Hämtar EN produkt baserat på ID
    {
        $stmt = $this->Connect()->prepare("SELECT pr.ID, ca.id as CategoryID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Price, pr.Description, 
        pr.Balance, pr.Discontinued FROM `products` AS pr 
        INNER JOIN categories AS ca ON pr.CategoryID = ca.ID 
        INNER JOIN colors AS co ON pr.ColorID = co.ID WHERE pr.ID = :id;");
        $stmt->bindParam(':id', $productID);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    function getAllColors() //Hämtar alla färger
    {
        $stmt = $this->Connect()->prepare("SELECT * FROM `colors`;");
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }

    function getAllCategories() //Hämtar alla kategorier
    {
        $stmt = $this->Connect()->prepare("SELECT * FROM `categories`;");
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }

    function getColorID($colorName) //Hämtar ID:t baserad på namnet
    {
        $stmt = $this->Connect()->prepare("SELECT ID FROM colors WHERE Name=:name;");
        $stmt->bindParam(":name", $colorName);
        $stmt->execute();
        $result = $stmt->fetch()['ID'];
        return $result;
    }

    function getCategoryID($categoryName) //Hämtar ID:t baserad på namnet
    {
        $stmt = $this->Connect()->prepare("SELECT ID FROM categories WHERE Name=:name;");
        $stmt->bindParam(":name", $categoryName);
        $stmt->execute();
        $result = $stmt->fetch()['ID'];
        return $result;
    }

    function setColorDB($color) //Lägger till ny färg
    {
        $stmt = $this->Connect()->prepare("INSERT INTO colors (Name) VALUES (:color);");
        $stmt->bindParam(':color', $color);
        $stmt->execute();
    }

    function setCategoryDB($category) //Lägger till ny kategori
    {
        $stmt = $this->Connect()->prepare("INSERT INTO categories (Name) VALUES (:category);");
        $stmt->bindParam(":category", $category);
        $stmt->execute();
    }

    function setNewProductDB($name, $category, $color, $description, $price, $balance) //Lägger till ny produkt
    {
        
        $stmt = $this->Connect()->prepare("INSERT INTO products (Name, CategoryID, ColorID, Description, Price, Balance, Discontinued) 
        VALUES (:name, :category, :color, :description, :price, :balance, 0)"); //0 = När ny produkt skapas förutsätt det att den ska finnas med i sortimentet
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":color", $color);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":balance", $balance);
        $stmt->execute();
    }

    function updateProductDB($id, $name, $category, $color, $description, $price, $balance, $discontinued) //Uppdaterar produktdata
    {
        $stmt = $this->Connect()->prepare("UPDATE products SET Name=:name, CategoryID=:category, ColorID=:color,
        Description=:description, Price=:price, Balance=:balance, Discontinued=:discontinued WHERE ID=:id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":color", $color);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":balance", $balance);
        $stmt->bindParam(":discontinued", $discontinued);
        $stmt->execute();
    }

    function updateBalance($id, $newBalance){ //Uppdaterar lagerstatus
        echo "Inside DB!<br>";
        $stmt = $this->Connect()->prepare("UPDATE products SET Balance=:balance WHERE ID=:id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":balance", $newBalance);
        $stmt->execute();
    }

    function deleteColor($id) //Tar bort färg
    {
        $stmt = $this->Connect()->prepare("DELETE FROM colors WHERE ID=:id;");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    function deleteCategory($id) //Tar bort kategori
    {
        $stmt = $this->Connect()->prepare("DELETE FROM categories WHERE ID=:id;");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    function getSimilarProducts($limit, $categoryid, $excludePID)
    {
        
        $stmt = $this->Connect()->prepare("SELECT pr.ID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Description, pr.Price, pr.Balance, pr.Discontinued
        FROM `products` AS pr INNER JOIN categories AS ca ON pr.CategoryID = ca.ID
        INNER JOIN colors AS co ON pr.ColorID = co.ID
        WHERE ca.id=:categoryID AND NOT pr.ID=:excludePID AND pr.Discontinued = 0
        ORDER BY RAND()        
        LIMIT :amount;");
        $stmt->bindParam(":categoryID", $categoryid, PDO::PARAM_INT);
        $stmt->bindParam(":excludePID", $excludePID, PDO::PARAM_INT);
        $stmt->bindValue(":amount", $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getLookedAtProducts($limit,$excludePID)
    {
        
        $stmt = $this->Connect()->prepare("SELECT pr.ID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Description, pr.Price, pr.Balance, pr.Discontinued
        FROM `products` AS pr INNER JOIN categories AS ca ON pr.CategoryID = ca.ID
        INNER JOIN colors AS co ON pr.ColorID = co.ID
        WHERE NOT pr.ID=:excludePID AND pr.Discontinued = 0
        ORDER BY RAND()        
        LIMIT :amount;");
        $stmt->bindParam(":excludePID", $excludePID, PDO::PARAM_INT);
        $stmt->bindValue(":amount", $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function GetSearchedProductsAllCriterias($question, $categorys, $colors)
    {
        
        $question = "%$question%";
        $colors = implode(",", $colors);
        $categorys =  implode(",", $categorys);

        $stmt = $this->Connect()->prepare("SELECT pr.ID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Description, pr.Price, pr.Balance, pr.Discontinued
        FROM `products` AS pr 
        INNER JOIN categories AS ca 
        ON pr.CategoryID = ca.ID
        INNER JOIN colors AS co 
        ON pr.ColorID = co.ID
        WHERE co.ID IN ($colors) AND ca.ID IN ($categorys) AND pr.name LIKE :question");
        $stmt->bindParam(":question", $question);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function GetSearchedProductsColor($question, $colors)
    {
        
        $question = "%$question%";
        $colors = implode(",", $colors);

        $stmt = $this->Connect()->prepare("SELECT pr.ID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Description, pr.Price, pr.Balance, pr.Discontinued
        FROM `products` AS pr 
        INNER JOIN categories AS ca 
        ON pr.CategoryID = ca.ID
        INNER JOIN colors AS co 
        ON pr.ColorID = co.ID
        WHERE co.ID IN ($colors) AND pr.name LIKE :question");
        $stmt->bindParam(":question", $question);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function GetSearchedProductsCategorys($question, $categorys)
    {
        
        $question = "%$question%";
        $categorys =  implode(",", $categorys);

        $stmt = $this->Connect()->prepare("SELECT pr.ID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Description, pr.Price, pr.Balance, pr.Discontinued
        FROM `products` AS pr 
        INNER JOIN categories AS ca 
        ON pr.CategoryID = ca.ID
        INNER JOIN colors AS co 
        ON pr.ColorID = co.ID
        WHERE ca.ID IN ($categorys) AND pr.name LIKE :question");
        $stmt->bindParam(":question", $question);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function GetSearchedProducts($question)
    {
        
        $question = "%$question%";

        $stmt = $this->Connect()->prepare("SELECT pr.ID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Description, pr.Price, pr.Balance, pr.Discontinued
        FROM `products` AS pr 
        INNER JOIN categories AS ca 
        ON pr.CategoryID = ca.ID
        INNER JOIN colors AS co 
        ON pr.ColorID = co.ID
        WHERE pr.name LIKE :question");
        $stmt->bindParam(":question", $question);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}





?>