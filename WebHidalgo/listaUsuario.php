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

$add = 0;

echo '<table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">LOGIN</th>
            <th scope="col">NOME</th>
            <th scope="col">CIDADE</th>
            <th scope="col">ESTADO</th>
        </tr>
        </thead>';
foreach($procura as $aux){

    $add = $add + 1;
    $id_usuario = $aux['USUID'];
    $txtusu = "SELECT USULOGIN,USUNOME,USUCIDA,USUESTA
                 FROM USUCAD 
                WHERE USUID = :id";
    $result = $con->prepare($txtusu);
    $params = array(
        'id'  => $id_usuario
    );
    $result->execute($params);
    $usuario = $result->fetch();

    $nome  = $usuario['USUNOME'];
    $login = $usuario['USULOGIN'];
    $cid   = $usuario['USUCIDA'];
    $uf    = $usuario['USUESTA'];
    echo '
          <tbody>
            <tr>
                <td>'. $login . '</td>
                <td>'. $nome . '</td>
                <td>'. $cid . '</td>
                <td>'. $uf . '</td>
            </tr>';
        
}
echo '</table>';
?>                        