<?php

require_once '../modelos/conexion.php';

header("Content-type: application/json; charset=utf-8");
header('Access-Control-Allow-Origin: *');

// Desactivar toda notificación de error
error_reporting(0);
 
// Notificar solamente errores de ejecución
error_reporting(E_ERROR | E_WARNING | E_PARSE);
 
// Notificar E_NOTICE también puede ser bueno (para informar de variables
// no inicializadas o capturar errores en nombres de variables ...)
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
 
// Notificar todos los errores excepto E_NOTICE
// Este es el valor predeterminado establecido en php.ini
error_reporting(E_ALL ^ E_NOTICE);
 
// Notificar todos los errores de PHP (ver el registro de cambios)
error_reporting(E_ALL);
 
// Notificar todos los errores de PHP
error_reporting(-1);
 
// Lo mismo que error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

//Select data from database
 
$getData = "select * from pais ORDER BY Pais";
$qur = $conexion->query($getData);

$i=0;

while($r = mysqli_fetch_assoc($qur)){
$msg[$i] = array("id_pais" => $r['id_pais'], "Codigo" => $r['Codigo'], "Pais" => $r['Pais']);
$i++;
}

$json = json_encode($msg, JSON_UNESCAPED_SLASHES);

echo $json;
@mysqli_close($conexion); 
?>