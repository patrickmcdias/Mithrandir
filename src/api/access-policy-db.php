<?
  require_once "database.php";
  class AccessPolicyDb extends Database {

  public function create($addressDb, $s_portDb, $d_portDb, $protocolDb, $filterDb, $actionDb, $commandDb){
    $sql = "insert into access_policy (address, s_port, d_port, protocol, filter, action, command)".
            " values ('{$addressDb}','{$s_portDb}', '{$d_portDb}', '{$protocolDb}', '{$filterDb}', '{$actionDb}', '{$commandDb}' now());";
    $this->connection->exec($actionDb
?>
