<?php
require_once('model/Cart.Model.php');

class CartController {

    function __destruct()
    {
        
    }

    function AddToCart($productID, $amount, $price){

        if (isset($_SESSION['ShoppingCart'][$productID])) { //add if allready in cart
            $_SESSION['ShoppingCart'][$productID][0] += (int)$amount;
            $_SESSION['ShoppingCart'][$productID][1] = (int)$price;
        }
        else
        {
            $_SESSION['ShoppingCart'][$productID][0] = $amount; //add to cart
            $_SESSION['ShoppingCart'][$productID][1] = $price;
        }
                
    }

    function UpdateProductInCart($productID, $amount){
        if ($amount == 0) {
            unset($_SESSION['ShoppingCart'][$productID]);
            if (count($_SESSION['ShoppingCart']) == 0) {
                unset($_SESSION['ShoppingCart']);
            }
        }
        else
        {
            $_SESSION['ShoppingCart'][$productID][0] = $amount; 
        }
    }
    //Tar in en array av HELA varukorgen och uppdaterar den.
    function UpdateCart($wholeCart){
    }

    function listCart(){
        $model = new CartModel();

        if (isset($_SESSION['ShoppingCart'])) {
            foreach ($_SESSION['ShoppingCart'] as $key => $value) {
                $products[] = $key;
            }
                    
            return $model->GetProductsSelective($products);
        }
        else
        {
            return 0;
        }
    }

    function Checkout(){

        $orderController = new OrderController();
        $msg = "";

        foreach ($orderController->ListSpecificOrder($orderController->ListLastOrderByUserId($_SESSION['userId'])) as $product) {
            $msg .= $product['ProductID'].'|'.$product['ProductName'].'|'.$product['Category'].'|'.$product['Color'].'|'.$product['Price'].'|'.$product['Amount'].'//';
        }

        //echo var_dump($msg);
        require_once('API.StaffanController.php');
        SendCheckoutMail($_SESSION['email'], $msg);
        unset($_SESSION['ShoppingCart']); //empty cart
    }

    function CurrentSum(){
        if (isset($_SESSION['ShoppingCart'])) {
            $sum = 0;
            foreach($_SESSION['ShoppingCart'] as $productID){ 
                
                $sum += ($productID[0] * $productID[1]);
        
            }
            return $sum;
        } else {
            return 0;
        }
    }

    function CurrentAmountOfItems(){
        if (isset($_SESSION['ShoppingCart'])) {
            $items = 0;
            foreach($_SESSION['ShoppingCart'] as $productID){ 
                $items += $productID[0];
            }
            return $items;
        } else {
            return 0;
        }
    }
}

?>