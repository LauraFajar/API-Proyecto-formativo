<?php

require_once '../config/Database.php';

class ReporteModels {
    private $conn;
    private $table_name = "reportes";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerPorFiltro($filtro) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE tipo = :filtro";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":filtro", $filtro);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
