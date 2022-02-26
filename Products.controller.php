<?php

require_once('Products.model.php');

class ProductController
{
    function __destruct(){

    }

    function listAllColors()
    {
        $model = new ProductDB();
        $arr = $model->getAllColors();

        echo '<pre>';
        var_dump($arr);
        echo '</pre>';
    }

    function listAllCategories()
    {
        $model = new ProductDB();
        $arr = $model->getAllCategories();

        echo '<pre>';
        var_dump($arr);
        echo '</pre>';
    }

    function listAllProducts()
    {
        $model = new ProductDB();
        $arr = $model->getAllProducts();

        // echo '<pre>';
        // var_dump($arr);
        // echo '</pre>';
        // foreach($arr as $x => $x_value)
        // {
        //     $arr2 = $x_value;
        //     foreach($arr2 as $y => $y_value)
        //     {
        //         echo "Key = " . $y . ", Value = " . $y_value." | ";
        //     }
        //     echo "<br><br>";
        // }

        // for ($i=0; $i < count($arr); $i++)
        // {   
        //     echo '<table>';
        //         echo '<tr>';
        //             echo '<th>ID</th>';
        //             echo '<th>Category</th>';
        //             echo '<th>Name</th>';
        //             echo '<th>Color</th>';
        //             echo '<th>Price</th>';
        //             echo '<th>Balance</th>';
        //             echo '<th>Discontinued</th>';
        //         echo '</tr>';
        //         echo '<tr>';
        //             echo '<td>Alfreds Futterkiste</td>';
        //             echo '<td>Maria Anders</td>';
        //             echo '<td>Germany</td>';
        //         echo '</tr>';
        //         echo '<tr>';
        //             echo '<td>Centro comercial Moctezuma</td>';
        //             echo '<td>Francisco Chang</td>';
        //             echo '<td>Mexico</td>';
        //         echo '</tr>';
        //     echo '</table>';
        // }

        if ($arr->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>Name</th></tr>";
            // output data of each row
            while($row = $arr->fetch_assoc()) {
                echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["Name"]. " " . $row["Price"]. "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        

       
       
    }

    function insertColor($color)
    {
        // $model = new ProductDB();
        // echo "Input: ".$color." [UNWASHED]"."<br>";
        // echo "Input: ".$this->washInput($color)." [WASHED]";
        // echo "<br>"."-------------------"."<br>";
        // echo $this->checkUserInput($color);
        // echo "<br>"."<br>"."<br>";
        // $input = $this->checkUserInput($color);
        // //$model->setColorDB($input);
    }

    function insertCategory($category)
    {
        $model = new ProductDB();
        echo "Input: ".$category." [UNWASHED]"."<br>";
        echo "Input: ".$this->washInput($category)." [WASHED]";
        echo "<br>"."-------------------"."<br>";
        echo $this->checkUserInput($category);
        echo "<br>"."<br>"."<br>";
        $input = $this->checkUserInput($category);
        //$model->setCategoryDB($input);
    }

    function washInput($input) //"Tvätta" användarinput på specialtecken och mellanslag. Ska returnera den tvättade inputen!
    {
        $input = htmlspecialchars($input, ENT_QUOTES);
        $input = trim($input, " ");
        $banlist = array(".",";"," ","/",",","<",">",")","(","=","[","]","-","*");
        $safeInput = str_replace($banlist,"",$input);
        return ucfirst($safeInput); //Capitalize first letter
        
    }

    function checkUserInput($input)
    {
        $model = new ProductDB();
        $arr = $model->getAllColors();
        $input = $this->washInput($input);
        $clr = "";
        if ($input == NULL || $input == "") 
        {
            return $msg = "Insertion failed: Invalid input!";
        }
        else
        {
            for ($i=0; $i<count($arr); $i++)
            { 
                $clr = $arr[$i]['Name'];
                
                if ($input == $clr) 
                {
                    return $msg = "Insertion failed: Input already exists in DB!";
                    break;
                }

            }
            if ($input != $clr) //Check if input not already exists
            {
                return $input;
            }
            else
            {
                return $msg = "ERROR! Something went wrong with the insertion.";
                
            }
        }
    }

}




?>