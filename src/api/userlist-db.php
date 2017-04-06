<?php
  require_once "database.php";

  class UserlistDb extends Database {

    public function create($username, $password){
      $password = md5($password);
      $sql = "insert into userlist (username, password)".
              " values ('{$username}','{$password}');";

      $this->connection->exec($sql);
    }

    public function readByUsernamePassword($username, $password){
      //$password = md5($password);
      $sql = "select * from userlist where username = '{$username}' and password = '{$password}'";
      $result = $this->connection->query($sql);

      if($result == false)
        return false;
      else {
         return $result->fetch();
      }
    }
  }
?>
