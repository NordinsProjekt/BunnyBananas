<?php
require_once "classes/PDOHandler.class.php";
class CartModel extends PDOHandler
{
    function __destruct()
    {
        
    }

    function GetProductsSelective($productsIDArray)
    {
        $where = "";
        for ($i=0; $i < Count($productsIDArray); $i++) {
            if ($i > 0) {
                $where .= ' OR pr.ID = ?';
            }
            else
            {
                $where = 'pr.ID = ?';
            } 
        }
        

      $sql = 'SELECT pr.ID, ca.Name AS Category, pr.Name, co.Name AS Color, pr.Price, pr.Balance, pr.Discontinued
      FROM `products` AS pr INNER JOIN categories AS ca ON pr.CategoryID = ca.ID
      INNER JOIN colors AS co ON pr.ColorID = co.ID WHERE '.$where.';';
      

      $stmt = $this->Connect()->prepare($sql);

      $stmt->execute($productsIDArray);

      return $stmt->fetchAll();
    }

}

?>