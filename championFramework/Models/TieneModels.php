<?php
class TieneModels {
    private $conn;
    private $table = "tiene";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crearRelacion($datos) {
        $query = "INSERT INTO " . $this->table . " (epa_id, cultivo_id) VALUES (:epa_id, :cultivo_id)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":epa_id", $datos['epa_id']);
        $stmt->bindParam(":cultivo_id", $datos['cultivo_id']);

        return $stmt->execute();
    }

    public function obtenerCultivosPorEpa($epa_id) {
        $query = "SELECT c.nombre FROM cultivos c
                  JOIN tiene t ON c.id = t.cultivo_id
                  WHERE t.epa_id = :epa_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":epa_id", $epa_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
