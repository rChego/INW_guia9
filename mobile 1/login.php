<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require 'estilos.php'; ?>
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>

    <body>        
        <div data-role="page">
            <div data-role="main" data-theme="a">
                <?php                
                    if(isset($_POST['submit'])){
                        $userURL = "http://pymesv.com/cliente04sw/servicio/ws/usuarios.php?opc=1&user=".$_POST["user"]."&pswd=".$_POST["pswd"];
                        $usuariosJSON = file_get_contents($userURL);    
                        $usuarios = json_decode($usuariosJSON);
                        
                        if ($usuarios != null) {                
                            foreach ($usuarios as $usuario) {
                                session_start();
                                $_SESSION["id_user"] = $usuario->id_usuario;
                                $_SESSION["user_name"] = $usuario->nombres;
                                $_SESSION["email"] = $usuario->email;                                                               
                                //Como pasa la validación de logeo es redireccionado al home del web site
                                echo "<script type='text/javascript'>window.location.assign('index.php');</script>";                    
                            }                
                        }else{
                            echo '<script type="text/javascript">alert("Usuario no encontrado");</script>';
                        }
                    }
                ?>
                <div class="ui-content center-wrapper">                
                    <form method="POST" action="login.php">
                    <div data-role="header"><h3>Iniciar sesión</h3></div>
                        <fieldset data-role="control-group" data-type="vertical">                                                      
                            <input type="text" name="user" id="user" placeholder="Correo Electrónico" data-clear-btn="true">
                            <input type="password" name="pswd" id="pswd" placeholder="Contraseña" data-clear-btn="true">
                        </fieldset>
                        <button name="submit" type="submit">Iniciar sesión</button> 
                    </form>
                </div>
            </div>        
        </div>
    </body>
</html>