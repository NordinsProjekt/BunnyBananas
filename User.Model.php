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

    function GetUserGroup($id)
    {
      $stmt = $this->Connect()->prepare('SELECT GroupName as name FROM groups
      INNER JOIN usergroups ON groups.ID = usergroups.GroupID 
      WHERE UserID =:id;');
      $stmt->bindParam(':id',$id,PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch();;
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
          $stmt = $this->Connect()->prepare('INSERT INTO users (username,password,email,disabled) VALUES(:username,:password,:email,0)');
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

    function GetAllGroups()
    {
      $stmt = $this->Connect()->prepare('SELECT id,grupp_namn as name FROM groups;');
      $stmt->execute();
      return $stmt->fetchAll();     
    }

    protected function SetGroup($gruppnamn)
    {
      if (!$this->CheckIfGroupExist($gruppnamn))
      {
        $stmt = $this->Connect()->prepare('INSERT INTO groups (GroupName) VALUES(:gruppnamn)');
        $param = [':gruppnamn'=>$gruppnamn];
        $stmt->execute($param);
        return true;
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