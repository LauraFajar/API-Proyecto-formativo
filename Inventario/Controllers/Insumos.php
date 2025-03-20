<?php

require_once '../Config/database.php';
require_once '../models/InsumoModels.php';

class Insumo {
    private $db;
    private $insumo;

    public function __construct() {
        $this->db = new Database();
        $this->insumo = new InsumoModels($this->db->getConnection());
    }

    public function obtenerTodos() {
        return $this->insumo->obtenerTodos();
    }

    public function crear($datos) {
        $this->insumo->codigo = $datos['codigo'];
        $this->insumo->nombre_insumo = $datos['nombre_insumo'];
        $this->insumo->fecha_entrada = $datos['fecha_entrada'];
        $this->insumo->observacion = $datos['observacion'];
        $this->insumo->id_categoria = $datos['id_categoria'];
        $this->insumo->id_almacen = $datos['id_almacen'];
        $this->insumo->id_salida = $datos['id_salida'];
        return $this->insumo->crear();
    }
}

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $insumo = new Insumo();
    if ($insumo->crear($data)) {
        echo json_encode(["message" => "Insumo creado exitosamente."]);
    } else {
        echo json_encode(["message" => "No se pudo crear el insumo."]);
    }
} else {
    echo json_encode(["message" => "Método no soportado."]);
}
