<?php
require_once "classes/PDOHandler.class.php";
class UserModel extends PDOHandler
{
    function __destruct()
    {
        
    }

    function GetAllUsersWithGroups()
    {
      //Prepare kräver execute()
      $stmt = $this->Connect()->prepare('SELECT ID, groups.GroupName,Username, Email, Disable FROM users
      INNER JOIN usergroups ON users.GroupID = usergroups.GroupID 
      INNER JOIN groups ON usergroups.GroupID = groups.ID;');
      $stmt->execute();
      return $stmt->fetchAll();
    }

    function GetUserById($id)
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
        $stmt = $this->Connect()->prepare('INSERT INTO groups (GroupName) VALUES(:gruppnamn)');
        $param = [':gruppnamn'=>$gruppnamn];
        $stmt->execute($param);
        return true;
    }

    function DeleteGroup($groupId)
    {
      $stmt = $this->Connect()->prepare("DELETE FROM groups WHERE ID=:groupId");
      $stmt->bindParam(':groupId',$groupId);
      $stmt->execute();
      return $stmt->fetch();
    }

    function SetReklam($userId)
    { 
      $stmt = $this->Connect()->prepare('INSERT INTO reklam (UserID) VALUES (:userId);');
      $stmt->bindParam(':userId',$userId);
      $stmt->execute();
      return $stmt->fetch();
    }

    function DeleteReklam($userId)
    {
      $stmt = $this->Connect()->prepare('DELETE FROM reklam WHERE UserId = :userId;');
      $stmt->bindParam(':userId',$userId);
      $stmt->execute();
      return $stmt->fetch();
    }

    function GetReklam($userId)
    {
      $stmt = $this->Connect()->prepare('SELECT COUNT(ID) as row FROM reklam WHERE UserID =:userId;');
      $stmt->bindParam(':userId',$userId);
      $stmt->execute();
      return $stmt->fetch();  
    }

    function SetGroupToUser($idArray)
    {
      $stmt = $this->Connect()->prepare('INSERT INTO usergroups (GroupID,UserID) VALUES (?,?);');
      $stmt->execute($idArray);
      return $stmt->fetch();
    }

    function CheckIfUserExists($username)
    {
      $stmt = $this->Connect()->prepare('SELECT COUNT(ID) as row FROM users WHERE username =:username;');
      $stmt->bindParam(':username',$username,PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetch();    
    }

    function GetUserByName($username)
    {
        $stmt = $this->Connect()->prepare('SELECT * FROM users WHERE username=:username');
        $stmt->bindParam(':username',$username,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    function SetUser($userArr)
    {    
      $stmt = $this->Connect()->prepare('INSERT INTO users (username,password,email,disable) VALUES(?,?,?,0)');
      $stmt->execute($userArr);
      return true;
    }

    function CheckIfGroupExist($gruppnamn)
    {
      $stmt = $this->Connect()->prepare('SELECT COUNT(ID) as row FROM groups WHERE GroupName =?;');
      $stmt->execute(array($gruppnamn));
      return $stmt->fetch();
    }
}

?>