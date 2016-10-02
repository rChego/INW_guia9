<?php
    session_start();    
    if (isset($_SESSION["email"])){
        echo '<div data-role="controlgroup" data-type="horizontal" class="ui-btn-left">';
            echo '<a data-role="button" href="index.php">Inicio</a>';
            echo '<a data-role="button" href="carrito.php">Carrito</a>';
            echo '<a data-role="button" href="historial.php">Historial</a>';
            echo '<a data-role="button" href="logout.php">Cerrar sesión</a>';
        echo '</div>';
        echo '<div data-role="controlgroup" data-type="horizontal" class="ui-btn-right">';
            echo '<a data-role="button" id="info">Bienvenido <b>'.$_SESSION["user_name"].'</b></a>';
            echo '<img src="https://gremyo.com/wp-content/uploads/2015/01/xcarro2.png.pagespeed.ic.eZ1l-iFow2.png" height="40" width="40">';
        echo '</div>';            
    }else{
        echo '<div data-role="controlgroup" data-type="horizontal" class="ui-btn-left">';
            echo '<a data-role="button" href="index.php">Inicio</a>';
            echo '<a data-role="button" href="registro.php">Registrarse</a>';
            echo '<a data-role="button" href="login.php">Login</a>';    
        echo '</div>';        
    }
?>