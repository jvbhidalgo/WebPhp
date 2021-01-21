<?php
session_start();
include("classes/connection.php");

$id_usuario = $_SESSION['usuario'];
$compet     = "%".$_POST["compet"]."%";

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
  echo round($retorno,2);
}
else{
  echo 'Data sem registro...';
}

?>                        