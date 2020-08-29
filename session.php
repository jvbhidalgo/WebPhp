<?php 
session_start(); 
$_SESSION['usuario'] = $user_data['usulg'];

echo $_SESSION['usuario']; 
?>