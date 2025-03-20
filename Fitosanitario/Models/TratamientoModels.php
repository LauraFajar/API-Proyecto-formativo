<?php

require_once __DIR__ . '/../Config/Conexion.php';

class TratamientoModels {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function crear($data) {
        $sql = "INSERT INTO tratamientos (nombre, descripcion, dosis, frecuencia, id_epa) VALUES (:nombre, :descripcion, :dosis, :frecuencia, :id_epa)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':descripcion', $data['descripcion']);
        $stmt->bindParam(':dosis', $data['dosis']);
        $stmt->bindParam(':frecuencia', $data['frecuencia']);
        $stmt->bindParam(':id_epa', $data['id_epa']);
        $stmt->execute();
        return $stmt->lastInsertId();
    }

    public function obtenerPorEpa($id_epa) {
        $sql = "SELECT * FROM tratamientos WHERE id_epa = :id_epa";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_epa', $id_epa);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}