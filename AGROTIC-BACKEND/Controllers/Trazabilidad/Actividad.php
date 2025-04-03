<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Actividad extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getActividades() {
        $data = $this->model->selectActividades();
        jsonResponse($data, 200);
    }

    public function getActividad($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectActividad($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Actividad no encontrada'], 404);
        }
    }

    public function createActividad() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateActividad($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $tipo_actividad = $_POST['tipo_actividad'];
        $fecha = $_POST['fecha'];
        $responsable = $_POST['responsable'];
        $detalles = $_POST['detalles'];
        $id_cultivo = $_POST['id_cultivo'];

        $result = $this->model->insertActividad($tipo_actividad, $fecha, $responsable, $detalles, $id_cultivo);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Actividad creada exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function updateActividad($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateActividad($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $tipo_actividad = $_POST['tipo_actividad'];
        $fecha = $_POST['fecha'];
        $responsable = $_POST['responsable'];
        $detalles = $_POST['detalles'];
        $id_cultivo = $_POST['id_cultivo'];

        $result = $this->model->updateActividad($id, $tipo_actividad, $fecha, $responsable, $detalles, $id_cultivo);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Actividad actualizada exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function deleteActividad($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteActividad($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Actividad eliminada exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], $result['msg']);
        }
    }
}