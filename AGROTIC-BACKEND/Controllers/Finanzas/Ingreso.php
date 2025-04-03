<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Ingreso extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getIngresos() {
        $data = $this->model->selectIngresos();
        jsonResponse($data, 200);
    }

    public function getIngreso($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectIngreso($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Ingreso no encontrado'], 404);
        }
    }

    public function createIngreso() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateIngreso($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $fecha_ingreso = $_POST['fecha_ingreso'];
        $monto = $_POST['monto'];
        $descripcion = $_POST['descripcion'];
        $id_insumo = $_POST['id_insumo'];

        if ($this->model === null) {
            error_log("Error: El modelo no está cargado.");
            jsonResponse(['status' => false, 'msg' => 'Error interno: modelo no cargado'], 500);
            return;
        }

        $result = $this->model->insertIngreso($fecha_ingreso, $monto, $descripcion, $id_insumo);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Ingreso registrado exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al registrar el ingreso'], 500);
        }
    }

    public function updateIngreso($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateIngreso($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $fecha_ingreso = $_POST['fecha_ingreso'];
        $monto = $_POST['monto'];
        $descripcion = $_POST['descripcion'];
        $id_insumo = $_POST['id_insumo'];

        if ($this->model === null) {
            error_log("Error: El modelo no está cargado.");
            jsonResponse(['status' => false, 'msg' => 'Error interno: modelo no cargado'], 500);
            return;
        }

        $result = $this->model->updateIngreso($id, $fecha_ingreso, $monto, $descripcion, $id_insumo);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Ingreso actualizado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al actualizar el ingreso'], 500);
        }
    }

    public function deleteIngreso($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteIngreso($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Ingreso eliminado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al eliminar el ingreso'], 500);
        }
    }
}