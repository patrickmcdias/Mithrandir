<?php
  require_once "access-policy-db.php";

  //ip block
  // http://localhost:1234/api/utils.php?option=-A&address=192.168.9.9&dport=80&sport=&filter=INPUT&prot=tcp&action=DROP
  $option = $_GET["option"] ?? null;
  $filter = $_GET["filter"] ?? null;
  $ip = $_GET["address"] ?? null;
  $prot = $_GET["prot"] ?? null;
  $d_port = $_GET["dport"] ?? null;
  $s_port = $_GET["sport"] ?? null;
  $action = $_GET["action"] ?? null;

    $command = "sudo iptables ";
    if ($option){
      $command.="{$option} ";
    }
    if ($filter){
      $command.="{$filter} ";
    }
    if ($ip){
      $command.="-s {$ip} ";
    }
    if ($prot){
      $command.="-p {$prot} ";
    }
    if ($d_port){
      $command.="--destination-ports {$d_port} ";
    }
    if ($s_port){
      $command.="--source-ports {$s_port} ";
    }
    if ($action){
      $command.="-j {$action}";
    }


  shell_exec($command);

  $accessPolicyDb = new AccessPolicyDb();
  $accessPolicyDb->create($ip, $s_port, $d_port, $prot, $filter, $action, $command);
  echo "Cadastro com sucesso";
