<div data-role="controlgroup" data-type="horizontal" class="ui-btn-left">
    <a data-role="button" href="index.php">Inicio</a>
    <a data-role="button" href="producto.php">Productos</a>
    <?php
        session_start();    
        if (isset($_SESSION["email"])){
            echo '<a data-role="button" href="carrito.php">Carrito</a>';
            echo '<a data-role="button" href="historial.php">Historial</a>';
            echo '<a data-role="button" href="logout.php">Cerrar sesión</a>';
                /*
            echo '<div class="text-right" title="'.$_SESSION["prods"].' productos">';
                echo '<span style="color: white">Bienvenido <b>'.$_SESSION["user_name"].'</b></span><img src="https://gremyo.com/wp-content/uploads/2015/01/xcarro2.png.pagespeed.ic.eZ1l-iFow2.png" height="50" width="50"><b style="color: rgb(214, 214, 214)">'.$_SESSION["prods"].'</b>';
            echo '</div>';*/
        }else{
            echo '<a data-role="button" href="registro.php">Registrarse</a>';
            echo '<a data-role="button" href="login.php">Login</a>';            
        }
    ?>
</div>