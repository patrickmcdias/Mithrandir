<?php
  require_once "access-policy-db.php";

  $accessPolicyDb = new AccessPolicyDb();
  $result=($accessPolicyDb->readAll());

  header("Content-type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  echo json_encode($result);
?>
