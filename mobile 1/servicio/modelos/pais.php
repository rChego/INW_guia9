<?php
// clase base con propiedades y métodos miembro
class Pais {

   var $id_tipo_usuario;
   var $id_pais;
   var $nombres;
   var $apellidos;
   var $email;
   var $password;
   var $conexion;

   //Bandera para verificar si se ha comprobado si el email ha sido repetido
   var $flag_email = false;

   function Usuario($id_tipo_usuario, $id_pais, $nombres, $apellidos, $email, $password, $conexion)
   {
       $this->id_tipo_usuario = $id_tipo_usuario;
       $this->id_pais = $id_pais;
       $this->nombres = $nombres;
       $this->apellidos = $apellidos;
       $this->email = $email;
       $this->password = $password;
       $this->conexion = $conexion;

   }

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

   function check_email()
   {
      $stmt = $this->conexion->prepare("SELECT * FROM usuario WHERE email = ?");
      $stmt->bind_param('s',$this->email);
      $stmt->execute();
      mysqli_stmt_bind_result($stmt, $id, $id_tipo, $id_pais ,$names, $lastNames, $email, $pass);
      $this->flag_email = true;

          /* si entramos al if la bandera a false! significa que encontramos un usuario con ese email */
          while (mysqli_stmt_fetch($stmt)) {
              $this->flag_email = false;
              echo "El email ya se encuentra registrado";
          }
   }

}
?>