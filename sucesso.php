<?php
  session_start();
  include("classes/connection.php");
  include("classes/funcao.class.php");
  include("autoload.html");

  $func = new Funcao();
  
  $id_usuario = $_SESSION['usuario'];

  if (isset($_POST['logout'])) {
    $_SESSION['usuario'] = null;
    $func->Redirect("login.php");
  }

  $txtusu = "SELECT USULOGIN,USUNOME,USUMAIL,USUFONE,USUCEP,
                    USURUA,USUBAIRRO,USUCIDA,USUESTA,USUENDN
               FROM USUCAD 
              WHERE USUID = :id";
  $result = $con->prepare($txtusu);
  $params = array(
    'id'  => $id_usuario
  );
  $result->execute($params);
  $usuario = $result->fetch();

  $nome       = $usuario['USUNOME'];
  $email      = $usuario['USUMAIL'];
  $telefone   = $usuario['USUFONE'];
  $cep        = $usuario['USUCEP'];
  $rua        = $usuario['USURUA'];
  $bairro     = $usuario['USUBAIRRO'];
  $cidade     = $usuario['USUCIDA'];
  $uf         = $usuario['USUESTA'];
  $numero     = $usuario['USUENDN'];
  
  

  include("sucesso.html");
?>