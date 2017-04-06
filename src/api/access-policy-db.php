<?php
  require_once "database.php";
  class AccessPolicyDb extends Database {

  public function create($addressDb, $s_portDb, $d_portDb, $protocolDb, $filterDb, $actionDb, $commandDb){
    $sql = "insert into access_policy (address, s_port, d_port, protocol, filter, action, command)".
            " values ('{$addressDb}','{$s_portDb}', '{$d_portDb}', '{$protocolDb}', '{$filterDb}', '{$actionDb}', '{$commandDb}');";

    echo $sql;
    var_dump($this->connection->exec($sql));
  }

  public function readAll (){
      $sql = "select * from access_policy;";

      $result = $this->connection->query($sql);

      return $result->fetchAll();
  }
}
