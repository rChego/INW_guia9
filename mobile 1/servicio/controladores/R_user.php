<?php
require_once '../modelos/conexion.php';
require_once '../modelos/usuario.php';
require_once '../modelos/tipo_usuario.php';

header('Access-Control-Allow-Origin: *');

$tipo_usuario = new TipoUser('comprador', 'tipo de usuario a buscar');

$tipo_usuario->select_tipo('comprador', $conexion);

$nombre = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$pais = $_POST['pais'];
$email = $_POST['email'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

if($pass1 == $pass2){

$usuario = new Usuario( $tipo_usuario->getId(),$pais,$nombre,$apellidos,$email,$pass1,$conexion);

$usuario->check_email();

$usuario->insert_user();

}
?>