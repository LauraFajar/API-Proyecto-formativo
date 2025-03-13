<?php

require_once '../config/Database.php';
require_once '../models/TratamientoModels.php';

class Tratamiento {
    private $db;
    private $tratamiento;

    public function __construct() {
        $this->db = new Database();
        $this->tratamiento = new TratamientoModels($this->db->getConnection());
    }

    public function registrar($datos) {
        return $this->tratamiento->crear($datos);
    }

    public function obtenerPorEpa($epa_id) {
        return $this->tratamiento->obtenerPorEpa($epa_id);
    }
}
