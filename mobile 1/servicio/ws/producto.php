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

//Opcion que se desea traer
//1 - los primeros 12
//2 - uno en especifico recibiendo id
//3 - todos

//Select data from database y por defecto
$getData = "select * from producto";

if(isset($_GET["opc"])){

	$opc = $_GET["opc"];

if($opc == 1){

	$getData = "select * from producto ORDER BY id_producto DESC LIMIT 12";


}else if($opc == 2){

	if(isset($_GET["id"])){

		$id = $_GET["id"];

		$getData = "select * from producto WHERE id_producto =  ".$id."";

	}


}else if($opc == 3){
	//consulta para traerlos todos
	$getData = "select * from producto";	
}
else if($opc == 4){
	//consulta para traerlos todos
	$getData = "select * from producto ORDER BY id_producto ASC LIMIT 6";	
}

}

$qur = $conexion->query($getData);
$i=0;
 
while($r = mysqli_fetch_assoc($qur)){
$msg[$i] = array("id_producto" => $r['id_producto'], "id_categoria" => $r['id_categoria'], "nombre" => $r['nombre'], "descripcion" => $r['descripcion'], "precio" => $r['precio'], "img" => $r['img'] );
$i++;
}

$json = json_encode($msg, JSON_UNESCAPED_SLASHES);

echo $json;
@mysqli_close($conexion); 
?>