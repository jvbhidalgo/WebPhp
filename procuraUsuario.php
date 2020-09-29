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

  $id_usuario               = $_SESSION['usuario'];

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

  
  $nome                     = $usuario['USUNOME'];
  $email                    = $usuario['USUMAIL'];
  $telefone                 = $usuario['USUFONE'];
  $cep                      = $usuario['USUCEP'];
  $rua                      = $usuario['USURUA'];
  $bairro                   = $usuario['USUBAIRRO'];
  $cidade                   = $usuario['USUCIDA'];
  $uf                       = $usuario['USUESTA'];
  $numero                   = $usuario['USUENDN'];
    

  if(isset($_POST['editar']) and $_POST['nome'] <> ''){

    $id_usuario  = $_SESSION['usuario'];
    $nome          = mb_strtoupper($func->limpaEspecial($_POST["nome"]));
    $email         = $_POST["email"];
    $telefone      = str_replace(' ','',$func->limpaEspecial($_POST["telefone"]));
    $cep           = str_replace(' ','',$func->limpaEspecial($_POST["cep"]));
    $uf            = $_POST["uf"];
    $bairro        = $_POST["bairro"];
    $cidade        = $_POST["cidade"];
    $rua           = $_POST["rua"];
    $numero        = $_POST["numero"];  

    $id = $id_usuario;

    $sql = "CALL atualizaUsuario(:nome,:email,:telefone,:cep,:rua,:bairro,:cidade,:uf,:numero,:id)";
    $result = $con->prepare($sql);
      
    $params = array(
      'nome'       => $nome,
      'email'      => $email,
      'telefone'   => $telefone,
      'cep'        => $cep,
      'rua'        => $rua,
      'bairro'     => $bairro,
      'cidade'     => $cidade,
      'uf'         => $uf,
      'numero'     => $numero,
      'id'         => $id
    );
    $result->execute($params);
    
    echo "<div style='text-align:center;'><h6 style='color:green;'>Usuario: $nome, Atualizado com sucesso!</h6></div>";

  }
  include("procuraUsuario.html");
  ?>