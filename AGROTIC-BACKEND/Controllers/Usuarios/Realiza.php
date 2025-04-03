<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Realiza extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getRealizas() {
        $data = $this->model->selectRealizas();
        jsonResponse($data, 200);
    }

    public function getRealiza($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectRealiza($id); 
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Relación no encontrada'], 404);
        }
    }

    public function createRealiza() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateRealiza($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $usuario = $_POST['usuario'];
        $actividad = $_POST['actividad'];

        if ($this->model === null) {
            error_log("Error: El modelo no está cargado.");
            jsonResponse(['status' => false, 'msg' => 'Error interno: modelo no cargado'], 500);
            return;
        }

        $result = $this->model->insertRealiza($usuario, $actividad);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Relación registrada exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al registrar la relación'], 500);
        }
    }

    public function updateRealiza($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateRealiza($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $usuario = $_POST['usuario'];
        $actividad = $_POST['actividad'];

        if ($this->model === null) {
            error_log("Error: El modelo no está cargado.");
            jsonResponse(['status' => false, 'msg' => 'Error interno: modelo no cargado'], 500);
            return;
        }

        $result = $this->model->updateRealiza($id, $usuario, $actividad);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Relación actualizada exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al actualizar la relación'], 500);
        }
    }

    public function deleteRealiza($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteRealiza($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Relación eliminada exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al eliminar la relación'], 500);
        }
    }
}