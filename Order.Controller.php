<?php
require_once('Order.Model.php');

class OrderController {

    function __destruct()
    {
        
    }

    function GetAllOrders(){

        $db = new OrderModel;

        return $db->GetAllOrders();
    }

    function GetSpecificOrder($value){

        $db = new OrderModel;

        return $db->GetSpecificOrder($value);
    }

}

?>