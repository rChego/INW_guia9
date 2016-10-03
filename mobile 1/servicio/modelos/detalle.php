<?php
// clase base con propiedades y métodos miembro
class Detalle {

   var $id_detalle_factura;
   var $id_factura;
   var $id_producto;
   var $cantidad;
   var $descuento;
   var $conexion;

   function Detalle($id_detalle_factura, $id_factura, $id_producto, $cantidad, $descuento, $conexion)
   {
       $this->id_detalle_factura = $id_detalle_factura;
       $this->id_factura = $id_factura;
       $this->id_producto = $id_producto;
       $this->cantidad = $cantidad;
       $this->descuento = $descuento;
       $this->conexion = $conexion;

   }
// METODO PARA INGRESAR NUEVO USUARIO
   function insert_detalle()
   {
        $stmt = $this->conexion->prepare("INSERT INTO detalle_factura (id_factura, id_producto, cantidad, descuento) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iidd", $this->id_factura, $this->id_producto, $this->cantidad, $this->descuento
        );
        

        if ($stmt->execute() === TRUE) {
            //echo "Detalle agregado";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conexion->error;
        }
   }

}
?>