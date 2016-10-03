<?php
// clase base con propiedades y métodos miembro
class Factura {

    var $id_factura;
    var $id_cliente;
    var $fecha;
    var $conexion;

   function Factura($id_factura, $id_cliente, $fecha, $conexion)
   {
       $this->id_factura = $id_factura;
       $this->id_cliente = $id_cliente;
       $this->fecha = $fecha;
       $this->conexion = $conexion;

   }
// METODO PARA INGRESAR NUEVO USUARIO
   function insert_factura()
   {
        $stmt = $this->conexion->prepare("INSERT INTO factura (id_cliente) VALUES (?)");
        $stmt->bind_param("i", $this->id_cliente);    

        if ($stmt->execute() === TRUE) {
            echo "Factura Agregada";
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
       }

   function getCurrent()
   {
      $stmt = $this->conexion->prepare("SELECT * FROM factura WHERE id_cliente = ? ORDER BY id_factura DESC limit 1");
      $stmt->bind_param('i',$this->id_cliente);
      $stmt->execute();
      mysqli_stmt_bind_result($stmt, $id_factura, $id_cliente, $fecha);

          /* si entramos al if la bandera a false! significa que encontramos un usuario con ese email */
          while (mysqli_stmt_fetch($stmt)) {
              $this->id_factura = $id_factura;
          }
   }

   function getId(){

    return $this->id_factura;
   }

}
?>