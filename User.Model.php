<?php
require_once "classes/PDOHandler.class.php";
class UserModel extends PDOHandler
{
    function __destruct()
    {
        
    }

    function GetAllUsers()
    {
      //Prepare kräver execute()
      $stmt = $this->Connect()->prepare('SELECT id,username as name,email FROM users;');
      $stmt->execute();
      return $stmt->fetchAll();       
    }

    function GetUser($id)
    {
      $stmt = $this->Connect()->prepare('SELECT * FROM users WHERE ID=:id;');
      $stmt->bindParam(':id',$id);
      $stmt->execute();
      return $stmt->fetch(); 
    }

    function GetUserId($username)
    {
      $stmt = $this->Connect()->prepare('SELECT ID FROM users WHERE Username = :username');
      $stmt->bindParam(':username',$username);
      $stmt->execute();
      return $stmt->fetch(); 
    }

    function GetUserShippingAddress($userId)
    {
      $stmt = $this->Connect()->prepare('SELECT Firstname,Lastname,Adress1,Adress2,Postort,Postnummer,Land 
      FROM users WHERE ID=:id;');
      $stmt->bindParam(':id',$userId);
      $stmt->execute();
      return $stmt->fetch();
    }

    function UpdateUserShippingAddress($userinputs)
    {
      $stmt = $this->Connect()->prepare('UPDATE users SET Firstname = ?, Lastname = ?, Adress1 = ?,
        Adress2 = ?, Postnummer = ?, Postort = ?, Land = ? WHERE ID = ?;');
      $stmt->bindParam(':id',$userId,PDO::PARAM_INT);
      $stmt->execute($userinputs);
    }
    function GetGroup($id)
    {
      $stmt = $this->Connect()->prepare('SELECT GroupName as name FROM groups WHERE ID = :id;');
      $stmt->bindParam(':id',$id);
      $stmt->execute();
      return $stmt->fetch(); 
    }

    function GetGroupId($groupName)
    {
      $stmt = $this->Connect()->prepare('SELECT ID FROM groups WHERE GroupName = :groupname;');
      $stmt->bindParam(':groupname',$groupName);
      $stmt->execute();
      return $stmt->fetch(); 
    }

    function GetAllGroups()
    {
      $stmt = $this->Connect()->prepare('SELECT ID, GroupName as name FROM groups;');
      $stmt->execute();
      return $stmt->fetchAll();     
    }

    function GetUserGroup($id)
    {
      $stmt = $this->Connect()->prepare('SELECT GroupName as name FROM groups
      INNER JOIN usergroups ON groups.ID = usergroups.GroupID 
      WHERE UserID =:id;');
      $stmt->bindParam(':id',$id,PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch();
    }

    function SetGroup($gruppnamn)
    {
      if (!$this->CheckIfGroupExist($gruppnamn))
      {
        $stmt = $this->Connect()->prepare('INSERT INTO groups (GroupName) VALUES(:gruppnamn)');
        $param = [':gruppnamn'=>$gruppnamn];
        $stmt->execute($param);
        return true;
      }
      return false;
    }

    function SetGroupToUser($idArray)
    {
      $stmt = $this->Connect()->prepare('INSERT INTO usergroups (GroupID,UserID) VALUES (?,?);');
      $stmt->execute($idArray);
      return $stmt->fetch();

    }
    private function CheckIfUserExists($username, $email)
    {
      $username = $this->CheckUserInputs($username);
      $stmt = $this->Connect()->prepare('SELECT * FROM users WHERE username =? OR email=?;');
      $stmt->execute(array($username,$email));
      if (count($stmt->fetchAll())>0)
      {
        return true;
      }
      else
      {
        return false;
      }      
    }

    function Login($username)
    {
        $stmt = $this->Connect()->prepare('SELECT * FROM users WHERE username=:username');
        $stmt->bindParam(':username',$username,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
    function SetUser($username,$password,$email)
    {
      $username = $this->CheckUserInputs($username);
      $password = $this->CheckUserInputs($password);
      
      if (!$this->CheckIfUserExists($username,$email))
      {
        if ($hashedPassword = password_hash($password, PASSWORD_DEFAULT))
        {
          $stmt = $this->Connect()->prepare('INSERT INTO users (username,password,email,disable) VALUES(:username,:password,:email,0)');
          $param = [
            ':username'=>$username,
            ':password'=>$hashedPassword,
            ':email'=>$email];
          $stmt->execute($param);

          return true;
        }
        else
        {
          return false;
        }
      }
      else
      {
        return false;
      }
    }

    protected function CheckIfGroupExist($gruppnamn)
    {
      $gruppnamn = $this->CheckUserInputs($gruppnamn);
      $stmt = $this->Connect()->prepare('SELECT * FROM groups WHERE GroupName =?;');
      $stmt->execute(array($gruppnamn));
      if (count($stmt->fetchAll())>0)
      {
          return true;
      }
      else
      {
        return false;
      }  
    }

    private function CheckUserInputs($notsafeText)
    {
      $banlist = array(".",";"," ","/",",","<",">",")","(","=","[","]");
      $safe = str_replace($banlist,"",$notsafeText);
      return $safe;
    }
}

?>