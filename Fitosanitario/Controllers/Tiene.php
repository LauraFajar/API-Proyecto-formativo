<?php
require_once '../config/Database.php';
require_once '../models/TieneModels.php';

class Tiene {
    private $tiene;

    public function __construct() {
        $db = new Database();
        $this->tiene = new TieneModels($db->getConnection());
    }

    public function asignar($datos) {
        return $this->tiene->crearRelacion($datos);
    }

    public function obtenerPorEpa($epa_id) {
        return $this->tiene->obtenerCultivosPorEpa($epa_id);
    }
}
?>
