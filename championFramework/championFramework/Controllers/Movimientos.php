<?php

require_once '../config/Database.php';
require_once '../models/MovimientoModels.php';

class Movimiento {
    private $db;
    private $movimiento;

    public function __construct() {
        $this->db = new Database();
        $this->movimiento = new MovimientoModels($this->db->getConnection());
    }

    public function obtenerTodos() {
        return $this->movimiento->obtenerTodos();
    }

    public function registrar($datos) {
        $this->movimiento->nombre = $datos['nombre'];
        $this->movimiento->codigo = $datos['codigo'];
        $this->movimiento->cantidad = $datos['cantidad'];
        $this->movimiento->unidad_medida = $datos['unidad_medida'];
        $this->movimiento->valor_unidad = $datos['valor_unidad'];
        $this->movimiento->responsable = $datos['responsable'];
        $this->movimiento->estado = $datos['estado'];
        $this->movimiento->fecha = $datos['fecha'];
        $this->movimiento->tipo = $datos['tipo'];
        return $this->movimiento->crear();
    }
}

