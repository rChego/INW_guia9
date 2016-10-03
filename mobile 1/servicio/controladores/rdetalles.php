<?php
require_once '../modelos/conexion.php';
require_once '../modelos/factura.php';
require_once '../modelos/detalle.php';

$factura = new Factura(null, $_POST['id_user'], null, $conexion);

$factura->insert_factura($conexion);

$factura->getCurrent();

$id = $factura->getId();

$total = count($_POST['cantidad']);;

if (isset($_POST['id_producto'])) {

	for ($i = 0; $i < $total; $i++) {
    	$detalle = new Detalle(null, $id, $_POST['id_producto'][$i], $_POST['cantidad'][$i], 0, $conexion);

		$detalle->insert_detalle();
	}

} else {
	echo "Error: no existencias";
}
;

?>