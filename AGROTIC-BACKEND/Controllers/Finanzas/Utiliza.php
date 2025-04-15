<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Utiliza extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getUtilizas() {
        $data = $this->model->selectUtilizas();
        jsonResponse($data, 200);
    }

    public function getUtiliza($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectUtiliza($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Relación no encontrada'], 404);
        }
    }

    public function createUtiliza() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateUtiliza($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $id_actividades = $_POST['id_actividades'];
        $id_insumos = $_POST['id_insumos'];

        if ($this->model === null) {
            error_log("Error: El modelo no está cargado.");
            jsonResponse(['status' => false, 'msg' => 'Error interno: modelo no cargado'], 500);
            return;
        }

        $result = $this->model->insertUtiliza($id_actividades, $id_insumos);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Relación registrada exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al registrar la relación'], 500);
        }
    }

    public function updateUtiliza($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateUtiliza($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $id_actividades = $_POST['id_actividades'];
        $id_insumos = $_POST['id_insumos'];

        if ($this->model === null) {
            error_log("Error: El modelo no está cargado.");
            jsonResponse(['status' => false, 'msg' => 'Error interno: modelo no cargado'], 500);
            return;
        }

        $result = $this->model->updateUtiliza($id, $id_actividades, $id_insumos);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Relación actualizada exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al actualizar la relación'], 500);
        }
    }

    public function deleteUtiliza($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteUtiliza($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Relación eliminada exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al eliminar la relación'], 500);
        }
    }
}