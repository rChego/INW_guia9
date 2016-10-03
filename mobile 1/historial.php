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
                <h2>Historial de compras</h2>
                <?php 
                    $historialURL = "http://pymesv.com/cliente04sw/servicio/ws/historial_compra.php?id=".$_SESSION["id_user"];
                    $historialJSON = file_get_contents($historialURL);
                    $historial= json_decode($historialJSON);

                    echo    '<table id="datos2">';
                    echo    '<tr>';
                    echo    '<th>Fecha de factura</th>';
                    echo    '<th>Hora de despacho</th>';
                    echo    '<th>Artículo</th>';
                    echo    '<th>Unidades</th>';
                    echo    '<th>Precio</th>';
                    echo    '<th>Descuento</th>';                   
                    echo    '<th>Total</th>';
                    echo    '</tr>';                
                    
                    foreach($historial as $histo){
                        echo    '<tr>';
                        echo    '<td>'.substr($histo->FechaFactura, 0, 10).'</td>';
                        echo    '<td>'.substr($histo->FechaFactura, 11).'</td>';
                        echo    '<td>'.$histo->NombreProducto.'</td>';                    
                        echo    '<td>'.$histo->Cantidad.'</td>';
                        echo    '<td> $'.$histo->PrecioProducto.'</td>';                    
                        echo    '<td> $'.$histo->DescuentoDetalleFactura.'</td>';
                        echo    '<td> $'.(($histo->Cantidad * $histo->PrecioProducto) - $histo->DescuentoDetalleFactura).'</td>';
                        echo    '</tr>';
                    }                   
                    echo    '</table>';
                ?>
            </div>
            <div data-role="footer" data-theme="a">
                <div class="iu-content">
                    <small>&copy; Rub&eacute;n Echegoy&eacute;n</small>
                </div>
            </div>
        </div>
    </body>
</html>