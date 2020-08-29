<?php
  session_start();
  include("classes/connection.php");
  include("classes/Funcao.class.php");
  include("autoload.html");
  include("cadastro.html");

  $bd   = new Banco();
  $func = new Funcao();
  
  if (isset($_POST['cada'])){
    $login         = $_POST["login"];
    $nome          = mb_strtoupper($func->limpaEspecial($_POST["nome"]));
    $pass          = $_POST["senha"];
    $email         = $_POST["email"];
    $telefone      = str_replace(' ','',$func->limpaEspecial($_POST["telefone"]));
    $cep           = str_replace(' ','',$func->limpaEspecial($_POST["cep"]));
    $uf            = $_POST["uf"];
    $bairro        = $_POST["bairro"];
    $cidade        = $_POST["cidade"];
    $rua           = $_POST["rua"];
    $numero        = $_POST["numero"];
    $cpass         = $_POST["csenha"];

    $sql = "SELECT usuid FROM usucad WHERE usulogin = :login";
    $result = $con->prepare($sql);
    
    $params = array(
        'login'  => strtoupper($login)
    );
    $result->execute($params);
    $usuario = $result->fetch();

    if (!$usuario){
      $sql = "CALL cadastraUsuario(:login,:nome,:email,:telefone,:cep,:rua,:bairro,:cidade,:uf,:numero,:pass)";
      $result = $con->prepare($sql);
      
      $params = array(
        'login'      => $login,
        'nome'       => $nome,
        'email'      => $email,
        'telefone'   => $telefone,
        'cep'        => $cep,
        'rua'        => $rua,
        'bairro'     => $bairro,
        'cidade'     => $cidade,
        'uf'         => $uf,
        'numero'     => $numero,
        'pass'       => $pass
      );
      $result->execute($params);

      echo "Usuario: $nome, Cadastrado com sucesso!";
    }
    else
      echo "Usuario já cadastrado";

  }

?>