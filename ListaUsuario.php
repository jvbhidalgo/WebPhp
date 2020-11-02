<?php
session_start();
include("classes/connection.php");

$palavra = $_POST['palavra'];

$nome_procura = "%".$palavra."%";

$txtprocura = "SELECT USUID
                 FROM USUCAD 
                WHERE USULOGIN LIKE :nome";
$result = $con->prepare($txtprocura);

$params = array(
    'nome'  => $nome_procura
);

$result->execute($params);
$procura = $result->fetchAll();

foreach($procura as $aux){

    $id_usuario = $aux['USUID'];
    $txtusu = "SELECT USULOGIN
                 FROM USUCAD 
                WHERE USUID = :id";
    $result = $con->prepare($txtusu);
    $params = array(
        'id'  => $id_usuario
    );
    $result->execute($params);
    $usuario = $result->fetch();

    $nome = $usuario['USULOGIN'];
    echo '<input readonly class="form-control" value="'. $nome . '" style="margin-bottom: 20px;">';
}
?>                        