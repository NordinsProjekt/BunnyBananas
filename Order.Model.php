<?php
require_once "classes/PDOHandler.class.php";
class OrderModel extends PDOHandler
{
    function __destruct()
    {
        
    }

    function GetAllOrders()
    {
      $sql = 'SELECT * FROM orders;';
      
      $stmt = $this->Connect()->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll();
    }

    Function GetSpecificOrder($orderID){

        $sql = 'SELECT orows.ProductID, o.ID, o.UserID, p.Name as ProductName, o.Date, orows.ProductID, col.Name as Color, c.Name as Category, orows.Amount, orows.Price, orows.Discount, o.Sent, o.Delivered
      FROM orderrows orows 
      INNER JOIN orders o 
      ON orows.OrderID = o.ID 
      INNER JOIN products p 
      ON orows.ProductID = p.ID
      INNER JOIN categories c
      ON p.CategoryID = c.ID
      INNER JOIN colors col
      ON p.ColorID = col.ID
      WHERE o.ID = ?;';

        $stmt = $this->Connect()->prepare($sql);
        $stmt->execute(array($orderID));
        $stmt->execute();
        
        return $stmt->fetchAll();


    }


}

?>