<?php
	session_start(); //Verificando que esté la sesión activa
	session_destroy(); //Destruyendo sesión
	header("location: index.php"); //Redireccionando a index.php
	exit();
?>