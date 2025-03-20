<?php

class NotificacionesModels {
    private $conn;
    private $table_name = "notificaciones";

    public $id;
    public $mensaje;
    public $tipo;
    public $destinatario;
    public $fecha_envio;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function enviar() {
        $query = "INSERT INTO " . $this->table_name . " (mensaje, tipo, destinatario, fecha_envio) 
                  VALUES (:mensaje, :tipo, :destinatario, NOW())";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":mensaje", $this->mensaje);
        $stmt->bindParam(":tipo", $this->tipo);
        $stmt->bindParam(":destinatario", $this->destinatario);

        return $stmt->execute();
    }
}