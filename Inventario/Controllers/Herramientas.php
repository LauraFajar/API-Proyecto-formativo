<?php

require_once '../config/Database.php';
require_once '../models/HerramientaModels.php';

class Herramienta {
    private $db;
    private $herramienta;

    public function __construct() {
        $this->db = new Database();
        $this->herramienta = new HerramientaModels($this->db->getConnection());
    }

    public function obtenerTodas() {
        return $this->herramienta->obtenerTodos();
    }

    public function crear($datos) {
        $this->herramienta->codigo = $datos['codigo'];
        $this->herramienta->nombre = $datos['nombre'];
        $this->herramienta->cantidad = $datos['cantidad'];
        $this->herramienta->valor_unidad = $datos['valor_unidad'];
        $this->herramienta->precio = $datos['precio'];
        $this->herramienta->estado = $datos['estado'];

        return $this->herramienta->crear();
    }
}

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $herramienta = new Herramienta();
    if ($herramienta->crear($data)) {
        echo json_encode(["message" => "Herramienta creada exitosamente."]);
    } else {
        echo json_encode(["message" => "No se pudo crear la herramienta."]);
    }
} else {
    echo json_encode(["message" => "Método no soportado."]);
}