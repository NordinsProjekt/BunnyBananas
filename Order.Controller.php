<?php
require_once('Order.Model.php');

class OrderController {

    function __destruct()
    {
        
    }

    function ListAllOrders(){

        $db = new OrderModel;

        return $db->GetAllOrders();
    }

    function ListSpecificOrder($value){

        $db = new OrderModel;

        return $db->GetSpecificOrder($value);
    }

}

?>