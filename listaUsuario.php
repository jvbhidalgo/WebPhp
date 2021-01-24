<?php
session_start();
include("classes/connection.php");

$palavra = $_POST['palavra'];

$nome_procura = "%".$palavra."%";

$txtprocura = "SELECT IDCLI
                 FROM CLIENTES 
                WHERE NOMECLI LIKE :nome";
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
            <th scope="col">NOME</th>
            <th scope="col">TIPO</th>
            <th scope="col">CIDADE</th>
            <th scope="col">ESTADO</th>
        </tr>
        </thead>';
foreach($procura as $aux){

    $add = $add + 1;
    $id_usuario = $aux['IDCLI'];
    $txtusu = "SELECT IDCLI,NOMECLI,TIPODESC,CLICEP,CLICIDA
                 FROM CLIENTES,TIPO_PESSOA 
                WHERE IDCLI = :id
                  AND CLIENTES.TIPOID = TIPO_PESSOA.TIPOID";
    $result = $con->prepare($txtusu);
    $params = array(
        'id'  => $id_usuario
    );
    $result->execute($params);
    $usuario = $result->fetch();

    $nome  = $usuario['NOMECLI'];
    $login = $usuario['TIPODESC'];
    $cid   = $usuario['CLICEP'];
    $uf    = $usuario['CLICIDA'];
    echo '
          <tbody>
            <tr>
                <td>'. $nome. '</td>
                <td>'. $login. '</td>
                <td>'. $cid . '</td>
                <td>'. $uf . '</td>
            </tr>';
        
}
echo '</table>';
?>                        