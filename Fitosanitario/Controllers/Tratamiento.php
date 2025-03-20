<?php

require_once __DIR__ . '/../Config/Config.php';
require_once __DIR__ . '/../Config/Conexion.php';
require_once __DIR__ . '/../Models/TratamientoModels.php';

class Tratamiento {
    private $db;
    private $tratamiento;

    public function __construct() {
        $this->db = new Conexion();
        $this->tratamiento = new TratamientoModels($this->db->connect());
    }

    public function registrar() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($data['nombre']) || empty($data['descripcion']) || empty($data['dosis']) || empty($data['frecuencia']) || empty($data['id_epa'])) {
            http_response_code(400);
            echo json_encode(["error" => "Datos incompletos."]);
            return;
        }

        try {
            $result = $this->tratamiento->crear($data);
            http_response_code(201);
            echo json_encode(["message" => "Tratamiento registrado con éxito.", "id" => $result]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function obtenerPorEpa($id_epa) {
        try {
            $result = $this->tratamiento->obtenerPorEpa($id_epa);
            if ($result) {
                http_response_code(200);
                echo json_encode($result);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Tratamientos no encontrados."]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}