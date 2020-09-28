<?php 

  $database_username = "root";
  $database_password = "";
  $database_info = "mysql:host=localhost;dbname=testeiago";
  try
  {
      $con = new PDO($database_info, $database_username, $database_password);
  }
  catch(PDOException $e)
  {
      echo 'FALHOU';
  }
  
  class Banco{


    function retornaLinha($resultado){
      
      $ret = mysqli_num_rows($resultado);

      if ($ret > 0 ){
        return true;
      }
      else
        return false;
    }

    function Redirect($url, $permanent = false){
      header('Location: ' . $url, true, $permanent ? 301 : 302);

      exit();
    }

  }
  

?>