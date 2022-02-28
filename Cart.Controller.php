<?php


class CartController {

    function __destruct()
    {
        
    }

    function AddToCart($productID, $amount){

        $_SESSION['ShoppingCart'][$productID] = $amount;
                
    }

    function UpdateProductInCart($productID, $amount){

    }


    //Tar in en array av HELA varukorgen och uppdaterar den.
    function UpdateCart($wholeCart){

    }
}

?>