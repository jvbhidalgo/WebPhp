<?php
  session_start();
  include("connection.php");

  $bd = new Banco();
  
  
  $id_usuario = $_SESSION['usuario'];

  $txtusu = "SELECT usuid,usulg FROM USUCAD WHERE USUID = :id";
  $result = $con->prepare($txtusu);
  $params = array(
    'id'  => $id_usuario
  );
  $result->execute($params);
  $usuario = $result->fetch();

  $id   = $usuario['usuid'];
  $nome = $usuario['usulg'];

  include("sucesso.html");
?>