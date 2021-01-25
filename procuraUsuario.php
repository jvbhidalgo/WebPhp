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

  $txtusu = "SELECT TIPODESC,NOMECLI,CLICEP,CLICIDA,CLIRUA,CLIBAIRRO,
                    CLIESTA,CLIENDE
              FROM CLIENTES,TIPO_PESSOA
             WHERE IDCLI = :id
               AND CLIENTES.TIPOID = TIPO_PESSOA.TIPOID";
  $result = $con->prepare($txtusu);
  $params = array(
    'id'  => $id_usuario
  );
  $result->execute($params);
  $usuario = $result->fetch();
  $nome                    = $usuario['NOMECLI'];
  $cep                     = $usuario['CLICEP'];
  $rua                     = $usuario['CLIRUA'];
  $bairro                  = $usuario['CLIBAIRRO'];
  $uf                      = $usuario['CLIESTA'];
  $cidade                  = $usuario['CLICIDA'];
  $numero                  = $usuario['CLIENDE'];
  $tipo                    = $usuario['TIPODESC'];

  if(isset($_POST['editar']) and $_POST['nome'] <> ''){

    $id_usuario  = $_SESSION['usuario'];
    $nome          = $func->limpaEspecial($_POST["nome"]);
    $cep           = str_replace(' ','',$func->limpaEspecial($_POST["cep"]));
    $uf            = $_POST["uf"];
    $bairro        = $_POST["bairro"];
    $cidade        = $_POST["cidade"];
    $rua           = $_POST["rua"];
    $numero        = $_POST["numero"]; 
    $tipo          = $_POST['tipo']; 

    $id = $id_usuario;

    $sql = "CALL atualizaPessoa(:tipo,:nome,:cep,:rua,:bairro,:cidade,:uf,:numero,:id)";
    $result = $con->prepare($sql);
    
    if($tipo == 'PF')
      $tipoP = 1;
    else
      $tipoP = 2;
    $params = array(
      'tipo'       => $tipoP,
      'nome'       => strtoupper($nome),
      'cep'        => $cep,
      'rua'        => $rua,
      'bairro'     => $bairro,
      'cidade'     => $cidade,
      'uf'         => $uf,
      'numero'     => $numero,
      'id'         => $id
    );
    $result->execute($params);
    
    header("Refresh:0");
    echo '<script language="javascript">';
    echo 'alert("Usuário atualizado!")';
    echo '</script>';

  }
  include("procuraUsuario.html");
  ?>