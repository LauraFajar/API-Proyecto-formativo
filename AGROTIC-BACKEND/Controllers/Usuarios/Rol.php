<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Rol extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getRoles() {
        $data = $this->model->selectRoles();
        jsonResponse($data, 200);
    }

    public function getRol($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectRol($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Rol no encontrado'], 404);
        }
    }

    public function createRol() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        // Validar datos
        $errors = Validator::validateRol($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        // Procesar datos si no hay errores
        $nombre_rol = $_POST['nombre_rol'];
        $id_tipo_rol = $_POST['id_tipo_rol'];

        // Depuración: Verificar si el modelo está cargado
        if ($this->model === null) {
            error_log("Error: El modelo no está cargado.");
            jsonResponse(['status' => false, 'msg' => 'Error interno: modelo no cargado'], 500);
            return;
        }

        $result = $this->model->insertRol($nombre_rol, $id_tipo_rol);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Rol registrado exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function updateRol($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateRol($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $nombre_rol = $_POST['nombre_rol'];
        $id_tipo_rol = $_POST['id_tipo_rol'];

        $result = $this->model->updateRol($id, $nombre_rol, $id_tipo_rol);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Rol actualizado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function deleteRol($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteRol($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Rol eliminado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }
}