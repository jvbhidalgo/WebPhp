<?php 

  $database_username = "root";
  $database_password = "";
  $database_info = "mysql:host=localhost;dbname=verificando";
  try
  {
      $con = new PDO($database_info, $database_username, $database_password);
  }
  catch(PDOException $e)
  {
      echo 'FALHOU';
  }

?>