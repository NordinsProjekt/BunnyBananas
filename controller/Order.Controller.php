<?php
require_once('model/Order.Model.php');

class OrderController {

    function __destruct()
    {
        
    }

    function ListAllOrders(){ //returnerar alla ordrar

        $db = new OrderModel();

        return $db->GetAllOrders();
    }

    function ListSpecificOrder($value){ //returnerar en specifik order 

        $db = new OrderModel();

        return $db->GetSpecificOrder($value);
    }

    function ListOrdersByUser($userId) //returnerar alla ordrar för en specifk användare
    {
        $db = new OrderModel;

        return $db->GetAllOrdersByUserId($userId);
    }

    function ListLastOrderByUserId($userId) //returnerar senast lagdra order (används för att visa kvitto i checkout)
    {
        $db = new OrderModel;

        return $db->GetLastOrderByUserId($userId);
    }


    
    function ListTotalCostSpecificOrder($userId) //returnerar totalsumma för ett specifikt kvitto
    {
        $db = new OrderModel;

        return $db->GetTotalCostSpecificOrder($userId);
    }
    
    function SendOrder(){ //förmedlar en order som är sparad i $_SESSION['ShoppingCart']

        $model = new OrderModel();
        $productController = new ProductController();
        $productModel = new ProductDB();

        
        //Paketerar värden så dom fungerar med modelfunktionen
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


        
        //Paketerar varje orderrad samt korrigerar köpt saldo till MAX det som finns i lager och uppdaterar lagersaldo.
        foreach ($_SESSION['ShoppingCart'] as $productID => $value ){
            $balance = $productModel->getProduct($productID)['Balance'];
            if ($value[0] > $balance){ //set antal till antal i lager om vi försöker beställa fler än antal i lager.
                $amount = $balance;
            }else{
                $amount = $value[0];
            }

            $orderRows[] = array($productID, $value[1], $amount, 0);
            $productController->updateCurrentBalance($productID, $amount); //uppdaterar lagersaldo med antal köptvara
        }

        //echo var_dump($orderRows);

        $model->SetOrder($order,$orderRows);

    }      
}

?>