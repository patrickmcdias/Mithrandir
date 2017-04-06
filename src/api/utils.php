<?
    require_once __DIR__."./access_policy-db.php";
  //ip block
  $option = $_GET["option"] ?? null;
  $filter = $_GET ["filter"] ?? null;
  $ip = $_GET ["ip"] ?? null ;
  $prot = $_GET ["prot"] ?? null;
  $d_port = $_GET ["dport"] ?? null;
  $s_port = $_GET ["sport"] ?? null;
  $action = $_GET ["action"] ?? null;

  function getCommand (){
    $command = "iptables "
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
      $command.="--destination-ports {$dport} ";
    }
    if ($s_port){
      $command.="--source-ports {$sport} ";
    }
    if ($action){
      $command.="-j {$action}";
    }
  }

  shell_exec($command);

  $accessPolicyDb = new AccessPolicyDb("mysql", "access_policy", "localhost", "root", "abc123");
  $addressDb = $ip;
  $s_portDb = $s_port;
  $d_portDb = $d_port;
  $filterDb = $filter;
  $actionDb = $action;
  $commandDb = $command;
  $accessPolicyDb>create($addressDb, $s_portDb, $d_portDb, $protocolDb, $filterDb, $actionDb, $commandDb);

?>
