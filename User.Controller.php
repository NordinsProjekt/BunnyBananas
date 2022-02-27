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
    function AddNewUser($username,$password,$email,$groupId)
    {
        $db = new UserModel();
        if ($db->SetUser($username,$password,$email))
        {
            $userId = $db->GetUserId($username);
            $arr = array (
                $groupId,$userId['ID']
            );
            $db->SetGroupToUser($arr);
            echo "Användaren skapades och lades till i en grupp";
        }
        else
        {
            echo "Användaren skapades inte";
        }
    }

    function AddUserToGroup($userId,$groupId)
    {

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
                if ($group) //Om detta är false tillhör inte användaren en grupp.
                {
                    foreach ($group as $row => $item) {
                        if (strtoupper($item) === "ADMIN")
                        {
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }
    function GetAllUserGroups()
    {
        $db = new UserModel();
        $arr = $db->GetAllGroups();
        return $arr;
    }

    function GetShippingAddress()
    {
        $db = new UserModel();
        if (isset($_SESSION['userId']) && $_SESSION['userId']>0)
        {
            $result = $db->GetUserShippingAddress($_SESSION['userId']);
            return $result;
        }
        return array("");
    }
    function SaveShippingAddress($firstname,$lastname,$address1,$address2,$postalcode,$postalarea,$country)
    {
        $userinputs = array(
            $this->CheckShippingAddress($firstname),$this->CheckShippingAddress($lastname),
            $this->CheckShippingAddress($address1),$this->CheckShippingAddress($address2),
            $this->CheckShippingAddress($postalcode),$this->CheckShippingAddress($postalarea),
            $this->CheckShippingAddress($country), $_SESSION['userId']
        );
        $db = new UserModel();
        $db->UpdateUserShippingAddress($userinputs);
    }
    function GetLetterArray(){
        $letterArray = array('a','b','c','d');
        return $letterArray;
    }
    private function CheckShippingAddress($notsafeText)
    {
        $banlist = array(".",";",",","<",">",")","(","=","[","]");
        $safe = str_replace($banlist,"",$notsafeText);
        return $safe;
    }
    private function CheckUserInputs($notsafeText)
    {
      $banlist = array(".",";"," ","/",",","<",">",")","(","=","[","]");
      $safe = str_replace($banlist,"",$notsafeText);
      return $safe;
    }
}


?>