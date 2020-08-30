<?php
  session_start();
  include("classes/connection.php");
  include("autoload.html");

  $bd = new Banco();

  $error = 0;

  if (isset($_POST['cada'])){
    $nome = $_POST["login"];
    $pass = $_POST["senha"];

    $sql = "SELECT usuid FROM usucad WHERE usulogin = :name and ususenha = :senha";
    $result = $con->prepare($sql);
    
    $params = array(
        'name'  => $nome,
        'senha' => $pass
    );
    $result->execute($params);
    $usuario = $result->fetch();

    if ($usuario){
      $_SESSION['usuario'] = $usuario['usuid'];
      $bd->Redirect("sucesso.php");
    }
    else
     $error = 1;
    
  }


  include("login.html");
?>