<?php
class Salidas {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrarSalida($nombre, $codigo, $cantidad, $categoria, $almacen, $observacion = null) {
        $query = "INSERT INTO salidas (nombre, codigo, cantidad, id_categoria, id_almacen, observacion, fecha_salida) VALUES (:nombre, :codigo, :cantidad, :categoria, :almacen, :observacion, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":codigo", $codigo);
        $stmt->bindParam(":cantidad", $cantidad);
        $stmt->bindParam(":categoria", $categoria);
        $stmt->bindParam(":almacen", $almacen);
        $stmt->bindParam(":observacion", $observacion);

        return $stmt->execute();
    }

    public function obtenerSalidas() {
        $query = "SELECT * FROM salidas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerSalidaPorId($id) {
        $query = "SELECT * FROM salidas WHERE id_salida = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarSalida($id, $nombre, $codigo, $cantidad, $categoria, $almacen, $observacion = null) {
        $query = "UPDATE salidas SET nombre = :nombre, codigo = :codigo, cantidad = :cantidad, id_categoria = :categoria, id_almacen = :almacen, observacion = :observacion WHERE id_salida = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":codigo", $codigo);
        $stmt->bindParam(":cantidad", $cantidad);
        $stmt->bindParam(":categoria", $categoria);
        $stmt->bindParam(":almacen", $almacen);
        $stmt->bindParam(":observacion", $observacion);
        return $stmt->execute();
    }

    public function eliminarSalida($id) {
        $query = "DELETE FROM salidas WHERE id_salida = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>