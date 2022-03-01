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

    function GetAllOrdersByUserId($userId)
    {
      $sql = 'SELECT * FROM orders WHERE UserID = :userId;';
      $stmt = $this->Connect()->prepare($sql);
      $stmt->bindParam(':userId',$userId);
      $stmt->execute();
      return $stmt->fetchAll();
    }

    function GetLastOrderByUserId($userId)
    {
      $sql = 'SELECT ID FROM orders
              WHERE UserID = :userId
              ORDER BY ID DESC LIMIT 1;';

      $stmt = $this->Connect()->prepare($sql);
      $stmt->bindParam(':userId',$userId);
      $stmt->execute();
      return $stmt->fetch()['ID'];
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
                WHERE o.ID = :id;';

        $stmt = $this->Connect()->prepare($sql);

        $stmt->bindParam(':id',$orderID);
        $stmt->execute();
        return $stmt->fetchAll();


    }

    Function SetOrder($order, $orderRows){
      $sql = 'INSERT INTO orders (UserID, Date, Firstname, Lastname, Adress1, Adress2, Postort, Postnummer, Land) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';

      $dbh = $this->Connect();
      $stmt = $dbh->prepare($sql);

      $stmt->execute($order);

      foreach ($orderRows as $row){
        $this->SetOrderRows($dbh->lastInsertId(), $row);
      }

    }

    private Function SetOrderRows($orderID, $orderRow){
      $sql = 'INSERT INTO orderrows (ProductID, Price, Amount, Discount, OrderID) VALUES (?, ?, ?, ?, ?)';

      $orderRow[] = $orderID;

      
      $stmt = $this->Connect()->prepare($sql);

      $stmt->execute($orderRow);
    }


}

?>