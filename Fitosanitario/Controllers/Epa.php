<?php

require_once __DIR__ . '/../Config/Config.php';
require_once __DIR__ . '/../Config/Conexion.php';
require_once __DIR__ . '/../Models/EpaModels.php';

class Epa {
    private $epa;

    public function __construct() {
        $db = new Conexion();
        $this->epa = new EpaModels($db->connect());
    }

    public function registrar() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($data['nombre']) || empty($data['descripcion'])) {
            http_response_code(400);
            echo json_encode(["error" => "Datos incompletos."]);
            return;
        }

        try {
            $result = $this->epa->crear($data);
            http_response_code(201);
            echo json_encode(["message" => "EPA registrada con éxito.", "id" => $result]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function buscar($nombre = null) {
        if (!$nombre) {
            http_response_code(400);
            echo json_encode(["error" => "El nombre es requerido."]);
            return;
        }

        try {
            $result = $this->epa->buscarPorNombre($nombre);
            if ($result) {
                http_response_code(200);
                echo json_encode($result);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "EPA no encontrada."]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}