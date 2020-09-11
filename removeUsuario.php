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

  if (isset($_POST['procura'])){
    $error      = 0;
    $nome_procura = $_POST["proc"];
    
    $txtprocura = "SELECT USUID
                     FROM USUCAD 
                    WHERE USULOGIN LIKE :nome";
    $result = $con->prepare($txtprocura);
    
    $params = array(
      'nome'  => $nome_procura
    );
    $result->execute($params);
    $procura = $result->fetch();
    
    if($procura){

      $id_usuario = $procura['USUID'];
      
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
    }
    else{
      $error = 1;
    }
  }

  if(isset($_POST['remove']) and $_POST['nome'] <> ''){

    $nome          = mb_strtoupper($func->limpaEspecial($_POST["nome"]));
    $email         = $_POST["email"];
    $telefone      = str_replace(' ','',$func->limpaEspecial($_POST["telefone"]));
    $cep           = str_replace(' ','',$func->limpaEspecial($_POST["cep"]));
    $uf            = $_POST["uf"];
    $bairro        = $_POST["bairro"];
    $cidade        = $_POST["cidade"];
    $rua           = $_POST["rua"];
    $numero        = $_POST["numero"];  

    $txtprocura = "SELECT USUID
                     FROM USUCAD 
                    WHERE USUNOME LIKE :nome";
    $result = $con->prepare($txtprocura);
    
    $params = array(
      'nome'  => $nome
    );
    $result->execute($params);
    $procura = $result->fetch();

    $id = $procura['USUID'];

    $sql = "DELETE 
              FROM USUCAD
             WHERE USUID = :id";
    $result = $con->prepare($sql);
      
    $params = array(
      'id'         => $id
    );
    $result->execute($params);

    header("Refresh:0");
    echo '<script language="javascript">';
    echo 'alert("Usuário excluido")';
    echo '</script>';
    
  }
  
  include("removeUsuario.html");
  ?>