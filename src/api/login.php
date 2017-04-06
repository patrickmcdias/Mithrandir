<?php
  require_once "userlist-db.php";

  session_start();

  $username = $_POST['username'];
  $password = $_POST['password'];

  $userlistDb = new UserlistDb();
  $result = $userlistDb->readByUsernamePassword($username, $password);

  if($result != false){
    $_SESSION["user_id"] = $username;
    header("Location: ../public/home.html");
  }else{
    header("Location: ../index.html");
  }
?>
