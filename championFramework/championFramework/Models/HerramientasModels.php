<?php

require_once '../config/Database.php';

class HerramientaModels {
    private $conn;
    private $table_name = "herramientas";

    public $id;
    public $codigo;
    public $nombre;
    public $cantidad;
    public $valor_unidad;
    public $precio;
    public $estado;
    public $imagen;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " (codigo, nombre, cantidad, valor_unidad, precio, estado, imagen) 
                  VALUES (:codigo, :nombre, :cantidad, :valor_unidad, :precio, :estado, :imagen)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":codigo", $this->codigo);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":valor_unidad", $this->valor_unidad);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":estado", $this->estado);
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
