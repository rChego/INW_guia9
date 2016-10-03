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
				<h2>Detalles Producto</h2>
				<table id="datos">
			        <?php
				        if(isset($_GET["num"])){				        	
				            $id = $_GET["num"];				            
				            $productosURL = "http://pymesv.com/cliente04sw/servicio/ws/producto.php?opc=2&id=".$id;				            
				            $productosJSON = file_get_contents($productosURL);
				            $productos = json_decode($productosJSON);


				            foreach ($productos as $producto) {
				            	echo '<tr><td rowspan="5"><img src="'.$producto->img.'" alt="'.$producto->nombre.'" title="'.$producto->nombre.'" width="200" height="200"></td>';
				                echo '<td><h2>'.$producto->nombre.'</h2></td>';
				                echo '<tr><td><h3>$'.$producto->precio.'</h3></td></tr>';
				                echo '<tr><td><b>Precio: $'.$producto->descripcion.'</b></td></tr>';
				                echo '<tr><td><b>Cantidad:</b><input type="number" id="quantity" name="quantity"
				                min="0" step="1" value="1"></td></tr>';
				                echo '<tr><td><button class="btn-danger btn_carrito" data-inline="true" onclick="add_carrito()">Agregar</button></td></tr>';
				            }

				            echo '<script language="javascript">
					            	var id = '.$producto->id_producto.';
					            	var id_categoria = '.$producto->id_categoria.';
					            	var nombre = "'.$producto->nombre.'";
					            	var descripcion = "'.str_replace("'", "\"", $producto->descripcion).'";
					            	var precio = '.$producto->precio.';
					            	var img = "'.$producto->img.'";
				            	</script>';
				        }else{
				            echo "<script>alert('Referencia eliminada');</script>";
				        }
			        ?>
		        </table>
			</div>

			<div data-role="footer" data-theme="a">
				<div class="iu-content">
					<small>&copy; Rub&eacute;n Echegoy&eacute;n</small>
				</div>
			</div>

			<script type="text/javascript">
			    function add_carrito() {
			        var valor = document.getElementById("quantity").value;
		            //Tenemos acceso a las variables creadas en la parte de php en la seccion de script
		            var jsonData = [];
		            var bandera = true;
		            
		            //traer json si existe
		            if(localStorage.jsonData){
				        //Si existe localstorage recuperamos el json
		                jsonData = JSON.parse(localStorage.jsonData);
		                //recorremos el json en busca del producto a ver si se repite
		                for(i=0; i<jsonData.length; i++){
		                    //Si existe e prouducto
		                    if(jsonData[i]['id_producto'] == id){
					            //Bandera de no existe a false
		                        var bandera = false;
		                        var agree=confirm("El producto ya existe en su carrito! ¿desea adicionar la cantidad a su carrito?.");
		                        //Si le da agree en el alert
		                        if (agree){
		                            //Lo buscamos en el arreglo y le agregamos 1
		                            for(i=0; i<jsonData.length; i++){
							            if(jsonData[i]['id_producto'] == id){
		                                    jsonData[i]['Cantidad'] = parseInt(jsonData[i]['Cantidad']) + parseInt(document.getElementById("quantity").value);
		                                    localStorage.setItem("jsonData", JSON.stringify(jsonData));
		                                    alert("Agregado a carrito");
		                                    location.href = "index.php";
		                                }//End if encontrar roducto
		                            }//End for bucar producto
		                        }else{ //Else agree
			                            return false;
		                        }//end else
		                    }//End if buscar producto
		                } //End for

		                if(bandera){ // Bandera si el producto no fue encontrado agregarlo
		                    //El producto no existe
		                    jsonData.push({
		                    "id_producto": id,
		                    "id_categoria": id_categoria,
		                    "nombre": nombre,
		                    "descripcion": descripcion,
		                    "precio": precio,
		                    "Cantidad": valor,
		                    "img": img,
		                    });

		                    // ahora intentamos guardar jsonData en localstorage
		                    localStorage.setItem("jsonData", JSON.stringify(jsonData));
		                    alert("Agregado a carrito");
		                    location.href = "index.php";
		                }
		            }else{ //o existe localstorage
			            // inicializamos el objeto y lo poblamos el objeto (si, es otro personajede RPG, muy original)
		                jsonData.push({
		                    "id_producto": id,
		                    "id_categoria": id_categoria,
		                    "nombre": nombre,
		                    "descripcion": descripcion,
		                    "precio": precio,
		                    "Cantidad": valor,
		                    "img": img,
		                });

		                // ahora intentamos guardar jsonData en localstorage
		                localStorage.setItem("jsonData", JSON.stringify(jsonData));
		                alert("Agregado a carrito");
		                location.href = "index.php";
		            }
		        }
	        </script>
		</div>
	</body>
</html>