<?php
require_once "databas.php";
class UserController
{
    function __destruct()
    {
        
    }

    function VerifyUser($username,$password)
    {
        $db = new Database();
        $row = $db->Login($username,$password);
        //Kontrollerar lösenordet och att det är rätt användarnamn
        if (password_verify($password,$row['Password']) && $username === $row['Username'])
        {
        //Sätter sessions värden
        $_SESSION['userId'] = $row['id'];
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $row['email'];
        $_SESSION['is_logged_in'] = true;
        return true;
        }
    }
    function AddNewUser($username,$password,$email)
    {
        $db = new Database();
        $svar = $db->SetUser($username,$password,$email);
        if ($svar == true)
        {
            echo "Allt gick bra";
        }
        else
        {
            echo "Användaren skapades inte";
        }
    }
}
?>