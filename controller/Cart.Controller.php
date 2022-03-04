<?php
require_once('model/Products.Model.php');

class CartController {

    function __destruct()
    {
        
    }

    
    function AddToCart($productID, $amount, $price){ //Lägger till produkt i varukorgen.

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

    
    function UpdateProductInCart($productID, $amount){ //Uppdaterar en specifik produkt i varukorgen
        if ($amount == 0) {
            unset($_SESSION['ShoppingCart'][$productID]);
            if (count($_SESSION['ShoppingCart']) == 0) { //tarbort produkten om nya saldot = 0
                unset($_SESSION['ShoppingCart']);
            }
        }
        else
        {
            $_SESSION['ShoppingCart'][$productID][0] = $amount; //uppdaterar saldot
        }
    }

    
    function listCart(){ //Returnerar alla produkter som finns i varukorgen för att kunna användas i tex Views
        $model = new ProductDB();

        if (isset($_SESSION['ShoppingCart'])) { //paketerar om arrayen till en array av bara produktIDn. Så modelen får det den vill ha.
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

    function Checkout(){ //Förmedlar varukorgen, mailarkunden och sparar den i databas

        $orderController = new OrderController();
        $msg = "";

        //bygger mailet med varor som kunden handlat.
        foreach ($orderController->ListSpecificOrder($orderController->ListLastOrderByUserId($_SESSION['userId'])) as $product) {
            $msg .= $product['ProductID'].'|'.$product['ProductName'].'|'.$product['Category'].'|'.$product['Color'].'|'.$product['Price'].'|'.$product['Amount'].'//';
        }

        SendCheckoutMail($_SESSION['email'], $msg); //pratar med API och mailar till kunden

        unset($_SESSION['ShoppingCart']); //tömmer varukorgen efter förmedlad order
    }

    function CurrentSum(){ //returnerar totalsumma av varukorgen i sessions
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

    function CurrentAmountOfItems(){ //returnerar antalet varor i kundkorgen
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