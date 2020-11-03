<?php
  session_start();
  include("classes/connection.php");
  include("classes/Funcao.class.php");
  include("autoload.html");
  
  $func = new Funcao();

  $nome       = '';
  $email      = '';
  $telefone   = '';
  $cep        = '';
  $rua        = '';
  $bairro     = '';
  $cidade     = '';
  $uf         = '';
  $numero     = '';

  $id_usuario = $_SESSION['usuario'];
  
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

  if(isset($_POST['remove'])){

    $id = $_SESSION['usuario'];
    
    $sql = "DELETE 
              FROM USUCAD
             WHERE USUID = :id";
    $result = $con->prepare($sql);
      
    $params = array(
      'id'         => $id
    );
    $result->execute($params);

    $_SESSION['usuario'] = null;
    echo '<script language="javascript">';
    echo 'alert("Usuário excluido")';
    echo '</script>';
    $func->Redirect("index.php");
  }
  
  include("removeUsuario.html");
  ?>