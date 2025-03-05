<?php
class Almacenes {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrarAlmacen($nombre, $descripcion) {
        $query = "INSERT INTO almacenes (nombre, descripcion) VALUES (:nombre, :descripcion)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);
        return $stmt->execute();
    }

    public function obtenerAlmacenes() {
        $query = "SELECT * FROM almacenes";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerAlmacenPorId($id) {
        $query = "SELECT * FROM almacenes WHERE id_almacen = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarAlmacen($id, $nombre, $descripcion) {
        $query = "UPDATE almacenes SET nombre = :nombre, descripcion = :descripcion WHERE id_almacen = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);
        return $stmt->execute();
    }

    public function eliminarAlmacen($id) {
        $query = "DELETE FROM almacenes WHERE id_almacen = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>