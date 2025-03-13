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
        $this->herramienta->imagen = $datos['imagen'];
        return $this->herramienta->crear();
    }
}

