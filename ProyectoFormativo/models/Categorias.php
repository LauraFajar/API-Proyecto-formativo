<?php
class Categorias {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrarCategoria($nombre, $descripcion) {
        $query = "INSERT INTO categorias (nombre, descripcion) VALUES (:nombre, :descripcion)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);
        return $stmt->execute();
    }

    public function obtenerCategorias() {
        $query = "SELECT * FROM categorias";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerCategoriaPorId($id) {
        $query = "SELECT * FROM categorias WHERE id_categoria = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarCategoria($id, $nombre, $descripcion) {
        $query = "UPDATE categorias SET nombre = :nombre, descripcion = :descripcion WHERE id_categoria = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);
        return $stmt->execute();
    }

    public function eliminarCategoria($id) {
        $query = "DELETE FROM categorias WHERE id_categoria = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>