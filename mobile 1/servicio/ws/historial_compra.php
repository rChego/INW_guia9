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
 
if(isset($_GET["id"])){
	$id = $_GET["id"];
	$getData = "select producto.nombre, producto.precio, detalle_factura.cantidad, detalle_factura.descuento, factura.fecha from detalle_factura
		inner join factura on factura.id_factura = detalle_factura.id_factura
		inner join producto on producto.id_producto = detalle_factura.id_producto
		inner join usuario on usuario.id_usuario = factura.id_cliente
		where usuario.id_usuario = ".$id;
	$qur = $conexion->query($getData);
	$i=0;
	 
	while($r = mysqli_fetch_assoc($qur)){
	$msg[$i] = array("NombreProducto" => $r['nombre'], "PrecioProducto" => $r['precio'], "Cantidad" => $r ['cantidad'], 
		"DescuentoDetalleFactura" => $r['descuento'], "FechaFactura" => $r['fecha']);
	$i++;
	}

	$json = json_encode($msg, JSON_UNESCAPED_SLASHES);

	echo $json;
	@mysqli_close($conexion); 	
}
?>