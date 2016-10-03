<!DOCTYPE html>
<html lang="es">
	<head>
		<?php require 'estilos.php'; ?>
		<link rel="stylesheet" type="text/css" href="css/general.css">
	</head>
	<body>
		<div data-role="page">
			<div data-role="header" data-theme="b">
				<h1></h1>
				<?php require 'nav.php'; ?>
			</div>
			<div data-role="content" data-theme="a">			
				<h2>Productos</h2>
				<!--<div data-role="controlgroup" data-type="vertical" >
					<div data-role="controlgroup" data-type="horizontal" >-->
				<table id="datos"><tr>
					<?php
				        $productosURL = "http://pymesv.com/cliente04sw/servicio/ws/producto.php?opc=2";
				        $productosJSON = file_get_contents($productosURL);
				        $productos = json_decode($productosJSON);
				        $cont = 0;

				        foreach ($productos as $producto) {				        	
				        	if($cont == 3){
				        		$cont = 0;
				        		echo '</tr><tr>';
				        	}
				        	$cont++;
			        		echo '<td><a href="detalle.php?num='.$producto->id_producto.'"><img class="img-responsive" src="'.$producto->img.'" alt="'.$producto->nombre.'" width="100" height="100" title="'.$producto->nombre.'"></a></td>';
			        		echo '<td><a href="detalle.php?num='.$producto->id_producto.'" class="enlace">'.$producto->nombre.'</a><br>$'.$producto->precio.'</td>';
				        }
        			?>
        		</tr></table>
        	</div><br>

			<div data-role="footer" data-theme="a">
				<div class="iu-content">
					<small>&copy; Rub&eacute;n Echegoy&eacute;n</small>
				</div>
			</div>
		</div>
	</body>
</html>