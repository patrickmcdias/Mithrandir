<?php
  require_once "database.php";
  class AccessPolicyDb extends Database {

    public function create($addressDb, $s_portDb, $d_portDb, $protocolDb, $filterDb, $actionDb, $commandDb){
      $sql = "insert into access_policy (address, s_port, d_port, protocol, filter, action, command)".
              " values ('{$addressDb}','{$s_portDb}', '{$d_portDb}', '{$protocolDb}', '{$filterDb}', '{$actionDb}', '{$commandDb}');";

      $this->connection->exec($sql);
    }

    public function readAll (){
        $sql = "select * from access_policy;";

        $result = $this->connection->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteRow ($id){
      $sql = "delete from access_policy where id = '{$id}' ";
      $this->connection->exec($sql);
    }


    public function readById($id){
      $sql = "select * from access_policy where id={$id}";
      $result = $this->connection->query($sql);

      if($result == false){
        return false;
      }else{
        return $result->fetch(PDO::FETCH_ASSOC);
      }
    }

    public function readByInfo($addressDb, $s_portDb, $d_portDb, $protocolDb, $filterDb, $actionDb){
      $sql = "select id from access_policy where address='{$addressDb}' and s_port = '{$s_portDb}' and d_port = '{$d_portDb}' and protocol = '{$protocolDb}' and filter = '{$filterDb}' and action = '{$actionDb}';";
      $result = $this->connection->query($sql);

      if($result == false){
        return false;
      }else{
        return $result->fetch(PDO::FETCH_ASSOC);
      }
  }
}
