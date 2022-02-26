<?php
require_once "User.Model.php";
class UserController
{
    function __destruct()
    {
        
    }

    function VerifyUser($username,$password)
    {
        $db = new UserModel();
        $row = $db->Login($username);
        //Kontrollerar lösenordet och att det är rätt användarnamn
        if (password_verify($password,$row['Password']) && $username === $row['Username'])
        {
            //Sätter sessions värden
            $_SESSION['userId'] = $row['ID'];
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $row['Email'];
            $_SESSION['is_logged_in'] = true;
            return true;
        }
    }
    function AddNewUser($username,$password,$email)
    {
        $db = new UserModel();
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
    function VerifyUserAdmin()
    {
        $db = new UserModel();
        if(isset($_SESSION['userId']))
        {
            $id = $_SESSION['userId'];
            if ($id > 0)
            {
                $group = $db->GetUserGroup($id);
                foreach ($group as $row => $item) {
                    if (strtoupper($item) === "ADMIN")
                    {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    function GetLetterArray(){
        $letterArray = array('a','b','c','d');
        return $letterArray;
    }
}


?>