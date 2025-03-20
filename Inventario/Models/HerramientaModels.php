<?php

class HerramientaModels {
    private $conn;
    private $table_name = "herramientas";

    public $id_herramienta;
    public $codigo;
    public $nombre;
    public $cantidad;
    public $valor_unidad;
    public $precio;
    public $estado;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerTodos() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET codigo=:codigo, nombre=:nombre, cantidad=:cantidad, 
                      valor_unidad=:valor_unidad, precio=:precio, estado=:estado";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":codigo", $this->codigo);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":valor_unidad", $this->valor_unidad);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":estado", $this->estado);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}