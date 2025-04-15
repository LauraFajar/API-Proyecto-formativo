<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Epa extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getEpas() {
        $data = $this->model->selectEpas();
        jsonResponse($data, 200);
    }

    public function getEpa($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectEpa($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'EPA no encontrada'], 404);
        }
    }

    public function createEpa() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateEpa($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $nombre_epa = $_POST['nombre_epa'];
        $descripcion = $_POST['descripcion'];

        $result = $this->model->insertEpa($nombre_epa, $descripcion);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'EPA registrada exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al registrar la EPA'], 500);
        }
    }

    public function updateEpa($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        if (isset($_POST['nombre_epa']) && isset($_POST['descripcion'])) {
            $nombre_epa = $_POST['nombre_epa'];
            $descripcion = $_POST['descripcion'];

            error_log("Datos recibidos para actualizar: id = $id, nombre_epa = $nombre_epa, descripcion = $descripcion");

            $result = $this->model->updateEpa($id, $nombre_epa, $descripcion);
            if ($result['status']) {
                jsonResponse(['status' => true, 'msg' => 'EPA actualizada exitosamente'], 200);
            } else {
                jsonResponse(['status' => false, 'msg' => 'Error al actualizar la EPA'], 500);
            }
        } else {
            jsonResponse(['status' => false, 'msg' => 'Datos incompletos'], 400);
        }
    }

    public function deleteEpa($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteEpa($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'EPA eliminada exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al eliminar la EPA'], 500);
        }
    }
}