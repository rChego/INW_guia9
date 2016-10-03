<?php
//variables para la conexion

define('db_host', 'basews04.db.8917278.hostedresource.com');
define('db_user', 'basews04');
define('db_password','XZ7u67ADss89@');
define('db_name','basews04');

$conexion = new mysqli(db_host, db_user, db_password, db_name);

if ($conexion->connect_errno) {
	//printf("Conexión fallida: %s\n", $mysqli->connect_error);
    exit();
} else {
	//printf("Conexion exitosa");
}

/* cambiar el conjunto de caracteres a utf8 */
if (!$conexion->set_charset("utf8")) {
    //printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
} else {
    //printf("Conjunto de caracteres actual: %s\n", $conexion->character_set_name());
}

?>