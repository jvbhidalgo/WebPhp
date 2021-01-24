<?php
  session_start();
  include("classes/connection.php");
  include("classes/funcao.class.php");
  include("autoload.html");

  $func = new Funcao();

  $error = 0;


  if (isset($_POST['cada']) or isset($_POST['alt'])){
    $nome = "%".$_POST["nome"]."%";

    $sql = "SELECT IDCLI 
              FROM CLIENTES 
              WHERE NOMECLI LIKE :name";
    $result = $con->prepare($sql);
    
    $params = array(
        'name'  => $nome
    );
    $result->execute($params);
    $usuario = $result->fetch();

    if ($usuario){
      $_SESSION['usuario'] = $usuario['IDCLI'];
      if(isset($_POST['cada']))
        $func->Redirect("removeUsuario.php");
      else
        $func->Redirect("procuraUsuario.php");
    }
    else
      $error = 1;
    
  }
  

  include("login.html");
?>