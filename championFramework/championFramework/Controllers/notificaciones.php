<?php

require_once '../config/Database.php';
require_once '../models/NotificacionModels.php';

class Notificacion {
    private $db;
    private $notificacion;

    public function __construct() {
        $this->db = new Database();
        $this->notificacion = new NotificacionModels($this->db->getConnection());
    }

    public function enviar($datos) {
        $this->notificacion->mensaje = $datos['mensaje'];
        $this->notificacion->tipo = $datos['tipo'];
        $this->notificacion->destinatario = $datos['destinatario'];
        return $this->notificacion->enviar();
    }
}
