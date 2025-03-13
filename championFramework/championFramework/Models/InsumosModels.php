<?php

require_once '../config/Database.php';

class InsumoModels {
    private $conn;
    private $table_name = "insumos";

    public $id;
    public $codigo;
    public $nombre;
    public $numero_insumos;
    public $unidad_medida;
    public $valor_unidad;
    public $tipo;
    public $precio;
    public $descripcion;
    public $fecha_vencimiento;
    public $imagen;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " (codigo, nombre, numero_insumos, unidad_medida, valor_unidad, tipo, precio, descripcion, fecha_vencimiento, imagen) 
                  VALUES (:codigo, :nombre, :numero_insumos, :unidad_medida, :valor_unidad, :tipo, :precio, :descripcion, :fecha_vencimiento, :imagen)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":codigo", $this->codigo);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":numero_insumos", $this->numero_insumos);
        $stmt->bindParam(":unidad_medida", $this->unidad_medida);
        $stmt->bindParam(":valor_unidad", $this->valor_unidad);
        $stmt->bindParam(":tipo", $this->tipo);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":fecha_vencimiento", $this->fecha_vencimiento);
        $stmt->bindParam(":imagen", $this->imagen);

        return $stmt->execute();
    }

    public function obtenerTodos() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
