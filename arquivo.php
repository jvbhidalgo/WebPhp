<?php
  session_start();
  include("connection.php");
  include("cadastro.html");

  $bd = new Banco();
  
  if (isset($_POST['cada'])){
    $nome = $_POST["login"];
    $pass = $_POST["senha"];

    
    
    $txtreg = "select usulg from usucad where usulg = '$nome'";
    $result = mysqli_query($con,$txtreg);
    

    if ($bd->retornaLinha($result)){
      echo 'Usuário já cadastrado';
    }
    else{
      $reg = "insert into usucad(usulg,ususn) values ('$nome','$pass')";
      $result = mysqli_query($con,$reg);
      echo "Usuario: $nome, cadastrado com sucesso!" ;
    }
  }


  mysqli_close($con);
?>