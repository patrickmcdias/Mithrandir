<?php
  require_once "access-policy-db.php";

   $id = $_GET["id"] ?? null;

   $accessPolicyDb = new AccessPolicyDb();
   $result = $accessPolicyDb->readById($id);
   $command = $result['command'];

   $accessPolicyDb->deleteRow($id);

   $command = str_replace("-A", "-D", $command);

   $connection = ssh2_connect('localhost', 22);
   ssh2_auth_password($connection, 'ubuntu', 'ubuntu');
   $stream = ssh2_exec($connection, "sudo {$command}");
   stream_set_blocking($stream, true);
   $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
   $output = stream_get_contents($stream_out);
   echo "<pre>{$output}</pre>";

   header ("Location: ../public/status.html");
