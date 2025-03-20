<?php

require_once '../config/Database.php';
require_once '../models/ReporteModels.php';

class Reporte {
    private $db;
    private $reporte;

    public function __construct() {
        $this->db = new Database();
        $this->reporte = new ReporteModels($this->db->getConnection());
    }

    public function obtenerPorFiltro($filtro) {
        return $this->reporte->obtenerPorFiltro($filtro);
    }
}
