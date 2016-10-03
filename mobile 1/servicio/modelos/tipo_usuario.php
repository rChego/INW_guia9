<?php
// clase base con propiedades y métodos miembro
//Esta clase solo la utilizaremos para buscar el tipo usuario correspondiente
class TipoUser {

  var $id;
  var $nombre;
  var $descrip;

  function TipoUser($nombre, $descrip)
  {
   $this->nombre = $nombre;
   $this->descrip = $descrip;
 }

   /*
   function insert_user()
   {
       if($this->flag_email){

        $stmt = $this->conexion->prepare("INSERT INTO usuario (id_tipo_usuario, id_pais, nombres, apellidos, email, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissss", $this->id_tipo_usuario, $this->id_pais, $this->nombres, $this->apellidos, $this->email, $this->password
        );
        

        if ($stmt->execute() === TRUE) {
            echo "Usuario creado en la BD";
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
       }
   }
   */

   function select_tipo($nombre, $conexion)
   {
    $stmt = $conexion->prepare("SELECT * FROM tipo_usuario WHERE nombre = ?");
    $stmt->bind_param('s',$nombre);
    $stmt->execute();
    mysqli_stmt_bind_result($stmt, $id, $nombre, $descr);

    while (mysqli_stmt_fetch($stmt)) {
      $this->id = $id;
      $this->nombre = $nombre;
      $this->nombre = $descr;

      }
    }
    function getId(){
      return $this->id;
    }
}
?>