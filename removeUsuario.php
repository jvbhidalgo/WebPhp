<?php
  session_start();
  include("classes/connection.php");
  include("classes/funcao.class.php");
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
  
  $txtusu = "SELECT NOMECLI
                FROM CLIENTES 
              WHERE IDCLI = :id";
  $result = $con->prepare($txtusu);
  $params = array(
    'id'  => $id_usuario
  );
  $result->execute($params);
  $usuario = $result->fetch();

  $nome       = $usuario['NOMECLI'];

  if(isset($_POST['remove'])){

    $id = $_SESSION['usuario'];
    
    $sql = "DELETE 
              FROM CLIENTES
             WHERE IDCLI = :id";
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