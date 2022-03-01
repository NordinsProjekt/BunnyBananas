<?php
require_once('Order.Model.php');

class OrderController {

    function __destruct()
    {
        
    }

    function ListAllOrders(){

        $db = new OrderModel();

        return $db->GetAllOrders();
    }

    function ListSpecificOrder($value){

        $db = new OrderModel();

        return $db->GetSpecificOrder($value);
    }

    function ListOrdersByUser($userId)
    {
        $db = new OrderModel;

        return $db->GetAllOrdersByUserId($userId);
    }

    function ListLastOrderByUserId($userId)
    {
        $db = new OrderModel;

        return $db->GetLastOrderByUserId($userId);
    }

    function SendOrder(){

        $model = new OrderModel();

        //$sql = 'INSERT INTO orders (UserID, Date, Firstname, Lastname, Adress1, Adress2, Postort, Postnummer, Land) ';
        $order = array(
            $_SESSION['userId'], 
            date("Y-m-d H:i:s"), 
            $_POST['txtFirstname'], 
            $_POST['txtLastname'], 
            $_POST['txtAddress'], 
            $_POST['txtAddress2'], 
            $_POST['txtPostalcode'], 
            $_POST['txtPostalarea'],
            $_POST['txtCountry']
        );


        //$sql = 'INSERT INTO orderrows (ProductID, Price, Amount, Discount, OrderID) VALUES (? ? ? ? ?)';

        foreach ($_SESSION['ShoppingCart'] as $productID => $value ){

            $orderRows[] = array($productID, $value[1], $value[0], 0);

        }

        //echo var_dump($orderRows);

        $model->SetOrder($order,$orderRows);

    }      
}

?>