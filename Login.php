<?php
  session_start();
  include("classes/connection.php");
  include("autoload.html");
  include("login.html");

  $bd = new Banco();
  
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
     echo 'Usuário não cadastrado no sistema';
    
  }


  
?>