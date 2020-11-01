<?php
  session_start();
  include("classes/connection.php");
  include("classes/Funcao.class.php");
  include("autoload.html");
  
  $bd   = new Banco();

  $id_usuario = $_SESSION['usuario'];

  if (isset($_POST['inserir'])){

    $valor = $_POST["valor"];
    $comp  = $_POST["comp"];

    $txt_verifica = "SELECT COUNT(*) QTD
                       FROM REGUSU
                      WHERE REGCOMP like :comp
                        AND REGIDUSU = :id";
    $result = $con->prepare($txt_verifica);
    $params = array(
      'comp'  => "%".$comp."%",
      'id'    => $id_usuario
    );
    $result->execute($params);
    $verifica = $result->fetch();

    if ($verifica['QTD'] > 0){
      header("Refresh:0");
      echo '<script language="javascript">';
      echo 'alert("Já existe um registro para esse dia e mês")';
      echo '</script>';
    }
    else{

      $sql = "CALL insereValorDiario(:id,:comp,:valor)";
      $result = $con->prepare($sql);
      
      $params = array(
          'id'    => $id_usuario,
          'comp'  => $comp,
          'valor' => $valor
      );
      $result->execute($params);
      $res = $result->fetch();

      echo '<script language="javascript">';
      echo 'alert("Peso registrado para data: '.$comp.'")';
      echo '</script>';
    }
  }
  
  
  if (isset($_POST['competencia'])){
    $retorno = '';
    $compet = "%".$_POST["compet"]."%";

    $sql_mes = "SELECT SUM(REGVDIA) RETORNA, COUNT(*) QTD 
                FROM REGUSU 
              WHERE REGIDUSU = :id 
                AND REGCOMP like :compet";
    $result = $con->prepare($sql_mes);

    $params = array(
        'id'     => $id_usuario,
        'compet' => $compet
    );
    $result->execute($params);
    $mens = $result->fetch();

    $valmes = $mens['RETORNA'];
    $qtd    = $mens['QTD'];
    
    if ($qtd >0){
      $retorno = $valmes / $qtd;
    }
    
  }
  include("Registros.html");
?>