<?php

require_once '../config/Database.php';
require_once '../models/EpaModels.php';

class Epa {
    private $db;
    private $epa;

    public function __construct() {
        $this->db = new Database();
        $this->epa = new EpaModels($this->db->getConnection());
    }

    public function registrar($datos) {
        return $this->epa->crear($datos);
    }

    public function buscar($nombre) {
        return $this->epa->buscarPorNombre($nombre);
    }

    public function listar($pagina, $limite) {
        return $this->epa->listar($pagina, $limite);
    }

    public function actualizarDescripcion($id, $descripcion) {
        return $this->epa->actualizarDescripcion($id, $descripcion);
    }
}
