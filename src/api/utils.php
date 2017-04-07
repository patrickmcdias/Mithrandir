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

  $accessPolicyDb = new AccessPolicyDb();
  $accessPolicyDb->create($ip, $s_port, $d_port, $prot, $filter, $action, $command);

  $connection = ssh2_connect('localhost', 22);
  ssh2_auth_password($connection, 'ubuntu', 'ubuntu');
  $stream = ssh2_exec($connection, "sudo {$command}");
  stream_set_blocking($stream, true);
  $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
  $output = stream_get_contents($stream_out);
  echo "<pre>{$output}</pre>";

  header ("Location: ../public/status.html");
