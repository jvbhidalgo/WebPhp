<?php
  session_start();
  include("connection.php");
  include("cadastro.html");

  $bd = new Banco();
  
  if (isset($_POST['cada'])){
    $nome = $_POST["login"];
    $pass = $_POST["senha"];

    $sql = "SELECT usuid FROM usucad WHERE usulg = :name";
    $result = $con->prepare($sql);
    
    $params = array(
        'name'  => $nome
    );
    $result->execute($params);
    $usuario = $result->fetch();

    if (!$usuario){
      $sql = "CALL cadastraUsuario(:name,:pass)";
      $result = $con->prepare($sql);
      
      $params = array(
        'name'  => $nome,
        'pass'  => $pass
      );
      $result->execute($params);

      echo "Usuario: $nome, Cadastrado com sucesso!";
    }

  }

?>