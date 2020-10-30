<?php
  session_start();
  include("classes/connection.php");
  include("autoload.html");

  $bd = new Banco();

  $error = 0;
  
  if (isset($_SESSION['usuario']) <> ''){
    $bd->Redirect("sucesso.php");
  }
  else{

    if (isset($_POST['cada'])){
      $nome = $_POST["login"];
      $pass = $_POST["senha"];

      $sql = "SELECT USUID 
                FROM USUCAD 
               WHERE USULOGIN = :name 
                 and USUSENHA = :senha";
      $result = $con->prepare($sql);
      
      $params = array(
          'name'  => $nome,
          'senha' => $pass
      );
      $result->execute($params);
      $usuario = $result->fetch();

      if ($usuario){
        $_SESSION['usuario'] = $usuario['USUID'];
        $bd->Redirect("sucesso.php");
      }
      else
        $error = 1;
      
    }
  }

  include("login.html");
?>