<?php

require_once __DIR__ . '/../Config/Conexion.php';

class EpaModels {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function crear($data) {
        $sql = "INSERT INTO epa (nombre_epa, descripcion) VALUES (:nombre_epa, :descripcion)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre_epa', $data['nombre']);
        $stmt->bindParam(':descripcion', $data['descripcion']);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function buscarPorNombre($nombre) {
        $sql = "SELECT * FROM epa WHERE nombre_epa = :nombre_epa";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre_epa', $nombre);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}