<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class TipoRol extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getTipoRoles() {
        $data = $this->model->selectTipoRoles();
        jsonResponse($data, 200);
    }

    public function getTipoRol($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectTipoRol($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Tipo de rol no encontrado'], 404);
        }
    }

    public function createTipoRol() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateTipoRol($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $descripcion = $_POST['descripcion'];

        if ($this->model === null) {
            error_log("Error: El modelo no está cargado.");
            jsonResponse(['status' => false, 'msg' => 'Error interno: modelo no cargado'], 500);
            return;
        }

        $result = $this->model->insertTipoRol($descripcion);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Tipo de rol registrado exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function updateTipoRol($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateTipoRol($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $descripcion = $_POST['descripcion'];

        $result = $this->model->updateTipoRol($id, $descripcion);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Tipo de rol actualizado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function deleteTipoRol($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteTipoRol($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Tipo de rol eliminado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }
}