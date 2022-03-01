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
        $row = $db->GetUserByName($username);
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
    function AddNewUser($username,$password,$email,$groupId,$reklam)
    {
        //Tar bort dumma saker i userinputs
        $username = $this->CheckUserInputs($username);
        $password = $this->CheckUserInputs($password);
        $hashpassword = password_hash($password, PASSWORD_DEFAULT);
        $db = new UserModel();
        //Om mailen inte är ok eller de andra fälten tomma så blir det ingen ny användare.
        if ($this->ValidateEmail($email) && $username != "" && $hashpassword != false)
        {
            //Kollar om användaren finns
            if ($db->CheckIfUserExists($username,$email)['row'] == 0)
            {
                $arr = Array (
                    $username,$hashpassword,$email
                );
                //Skapar användaren
                if ($db->SetUser($arr))
                {
                    $userId = $db->GetUserId($username);
                    $arr = array (
                        $groupId,$userId['ID']
                    );
                    //Lägger användaren i en grupp
                    $db->SetGroupToUser($arr);
                    //Lägger till i reklamutskick
                    $db->SetReklam($userId['ID']);
                }
                else
                {
                    echo "Användaren skapades inte";
                }
            }
            else
            {
                echo "Användaren finns redan";
            }
        }

    }

    function AddUserToGroup($userId,$groupId)
    {
        $db = new UserModel();
        if ($userId > 0 && $groupId > 0)
        {
            $arr = array (
                $userId,$groupId
            );
            $db->SetGroupToUser($arr);
        }
        else
        {
            echo "Felaktiga grupp ID";
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
    
    function ListAllUserGroups()
    {
        $db = new UserModel();
        $arr = $db->GetAllGroups();
        return $arr;
    }

    function ListShippingAddress()
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
        //if sats för att kolla om användaren fortfarande vill ha reklamutskick?
        $db->UpdateUserShippingAddress($userinputs);
    }

    function AddGroup($groupName)
    {
        $groupName = $this->CheckUserInputs($groupName);
        $db = new UserModel();
        if ($db->CheckIfGroupExist($groupName)['row'] == 0)
        {
            $db->SetGroup($groupName);
        }
    }
    function AddToReklam($userId)
    {
        $db = new UserModel();
        if ($db->GetReklam($userId)['row'] == 0)
        {
            $db->SetReklam($userId);
        }
    }
    function RemoveReklam($userId)
    {
        $db = new UserModel();
        if ($db->GetReklam($userId)['row'] == 1)
        {
            $db->DeleteReklam($userId);
        }
    }

    private function ValidateEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else {
            return false;
        }
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