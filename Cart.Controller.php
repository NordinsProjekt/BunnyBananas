<?php
require_once('Cart.Model.php');

class CartController {

    function __destruct()
    {
        
    }

    function AddToCart($productID, $amount){

        if (isset($_SESSION['ShoppingCart'][$productID])) { //add if allready in cart
            $_SESSION['ShoppingCart'][$productID] = $_SESSION['ShoppingCart'][$productID] + $amount;
        }
        else
        {
            $_SESSION['ShoppingCart'][$productID] = $amount; //add to cart
        }
                
    }

    function UpdateProductInCart($productID, $amount){

        if ($amount == 0) {
            unset($_SESSION['ShoppingCart'][$productID]); 
        }
        else
        {
            $_SESSION['ShoppingCart'][$productID] = $amount; 
        }
        

    }


    //Tar in en array av HELA varukorgen och uppdaterar den.
    function UpdateCart($wholeCart){

    }

    function listCart(){
        $model = new CartModel();

        foreach ($_SESSION['ShoppingCart'] as $key => $value) {
            $products[] = $key;
        }
                
        return $model->GetProductsSelective($products);
        
    }
}

?>