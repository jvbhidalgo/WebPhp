<?php
	session_start();
	include("classes/connection.php");
	include("classes/Funcao.class.php");
	include("autoload.html");

	$bd = new Banco();
	
	if (isset($_POST['procura'])){

		$nome_procura = "%".$_POST["proc"]."%";

		$txtprocura = "SELECT USUID
									   FROM USUCAD 
								    WHERE USULOGIN LIKE :nome";
		$result = $con->prepare($txtprocura);

		$params = array(
			'nome'  => $nome_procura
		);

		$result->execute($params);
		$procura = $result->fetchAll();
		
    
	}
	include("listar.html");
?>