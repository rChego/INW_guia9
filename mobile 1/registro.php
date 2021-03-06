<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require 'estilos.php'; ?>
        <link rel="stylesheet" type="text/css" href="css/general.css">
        <script type="text/javascript" src="js/jquery.slickforms.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $('.forms').dcSlickForms();
            });
        </script>
    </head>
    <body>
        <div data-role="page">
            <div data-role="header" data-theme="b">
                <h1></h1>
                <?php require 'nav.php'; ?>
            </div>

            <div data-role="main" data-theme="a" class="ui-content">
                <div class="center-wrapper">
                    <h2>Formulario de registro</h2>
                    <form id="login" class="forms" action="http://pymesv.com/cliente04sw/servicio/controladores/R_user.php" method="POST">
                        <input type="text" name="nombres" placeholder="Ingrese sus nombres" class="text-input required" required="flag" data-inline="false"/>
                        <input type="text" name="apellidos" placeholder="Ingrese sus apellidos" class="text-input required" required="flag" data-inline="false"/>
                        <?php          
                            $productosURL = "http://pymesv.com/cliente04sw/servicio/ws/pais.php";
                            $productosJSON = file_get_contents($productosURL);
                            $productos = json_decode($productosJSON);
         
                            echo '<select name="pais" class="text-input required">';
                            foreach ($productos as $producto){
                                echo '<option value="'.$producto->id_pais.'">'.$producto->Pais.'</option>';
                            }
                            echo "</select>";
                        ?>
                        <input type="email" name="email" placeholder="Ingrese su email" value="" class="text-input required email" title="" required="flag"/>
                        <input type="password" name="pass1" placeholder="Ingrese su contraseña (6 CARACTERES MINIMO)" value="" class="text-input required" title="" pattern=".{6,}" required="flag"/>
                        <input type="password" name="pass2" placeholder="Repita la contraseña (6 CARACTERES MINIMO)" value="" class="text-input required" title="" pattern=".{6,}" required="flag"/><br>
                        <div class="center-wrapper">
                            <input type="submit" value="Crear cuenta" name="enviar" id="enviar" data-inline="true"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>