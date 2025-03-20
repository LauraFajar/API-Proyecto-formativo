<?php

require_once '../config/Database.php';

class MovimientoModels {
    private $conn;
    private $table_name = "movimientos";

    public $id;
    public $nombre;
    public $codigo;
    public $cantidad;
    public $unidad_medida;
    public $valor_unidad;
    public $responsable;
    public $estado;
    public $fecha;
    public $tipo;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " (nombre, codigo, cantidad, unidad_medida, valor_unidad, responsable, estado, fecha, tipo) 
                  VALUES (:nombre, :codigo, :cantidad, :unidad_medida, :valor_unidad, :responsable, :estado, :fecha, :tipo)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":codigo", $this->codigo);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":unidad_medida", $this->unidad_medida);
        $stmt->bindParam(":valor_unidad", $this->valor_unidad);
        $stmt->bindParam(":responsable", $this->responsable);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":tipo", $this->tipo);

        return $stmt->execute();
    }

    public function obtenerTodos() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
