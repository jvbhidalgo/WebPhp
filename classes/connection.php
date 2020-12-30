<?php 

  $database_username = "ba97608f39dcac";
  $database_password = "010cc935";
  $database_info = "mysql:host=ip-10-0-104-71;dbname=heroku_ff43c68a0daab53";
  try
  {
      $con = new PDO($database_info, $database_username, $database_password);
  }
  catch(PDOException $e)
  {
      echo 'FALHOU';
  }

?>