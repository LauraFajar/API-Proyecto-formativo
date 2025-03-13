<?php

require_once '../config/Database.php';
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
        $this->insumo->nombre = $datos['nombre'];
        $this->insumo->numero_insumos = $datos['numero_insumos'];
        $this->insumo->unidad_medida = $datos['unidad_medida'];
        $this->insumo->valor_unidad = $datos['valor_unidad'];
        $this->insumo->tipo = $datos['tipo'];
        $this->insumo->precio = $datos['precio'];
        $this->insumo->descripcion = $datos['descripcion'];
        $this->insumo->fecha_vencimiento = $datos['fecha_vencimiento'];
        $this->insumo->imagen = $datos['imagen'];
        return $this->insumo->crear();
    }
}
