<?php
  require_once "access-policy-db.php";

  $option = $_GET["option"] ?? null;
  $filter = $_GET["filter"] ?? null;
  $ip = $_GET["address"] ?? null;
  $prot = $_GET["prot"] ?? null;
  $d_port = $_GET["dport"] ?? null;
  $s_port = $_GET["sport"] ?? null;
  $action = $_GET["action"] ?? null;


  $command = "iptables ";

  if ($option){
    $command.="{$option} ";
  }
  if ($filter){
    $command.="{$filter} ";
  }
  if ($ip){
    $command.="-s {$ip} ";
  }else{
    $ip = "-";
  }
  if ($prot){
    $command.="-p {$prot} ";
  }
  if ($d_port){
    $command.="--dport {$d_port} ";
  }else{
    $d_port="-";
  }
  if ($s_port){
    $command.="--sport {$s_port} ";
  }else{
    $s_port="-";
  }
  if ($action){
    $command.="-j {$action}";
  }

  // $teste = "sudo su - {$command}";
  // shell_exec('sudo -u root -S '.$command.' < /var/www/html/src/passwd.secret');
  // echo $teste;
  // shell_exec('sudo su -');
  // shell_exec($command);

  $accessPolicyDb = new AccessPolicyDb();
  if($option == "-A"){
    $accessPolicyDb->create($ip, $s_port, $d_port, $prot, $filter, $action, $command);
    echo "New policy added successfully";
  }
  if ($option == "-D"){
    $id = $accessPolicyDb->readByInfo($ip, $s_port, $d_port, $prot, $filter, $action);

    $accessPolicyDb->deleteRow($id);
    echo "Policy was removed successfully";
  }
