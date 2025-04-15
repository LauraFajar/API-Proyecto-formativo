<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Tiene extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getTienes() {
        $data = $this->model->selectTienes();
        jsonResponse($data, 200);
    }

    public function getTiene($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectTiene($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Relación no encontrada'], 404);
        }
    }

    public function createTiene() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateTiene($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $cultivo = $_POST['cultivo'];
        $epa = $_POST['epa'];

        $result = $this->model->insertTiene($cultivo, $epa);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Relación creada exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function updateTiene($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateTiene($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $cultivo = $_POST['cultivo'];
        $epa = $_POST['epa'];

        $result = $this->model->updateTiene($id, $cultivo, $epa);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Relación actualizada exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function deleteTiene($cultivo, $epa) {
        if (!is_numeric($cultivo) || !is_numeric($epa)) {
            jsonResponse(['status' => false, 'msg' => 'IDs inválidos'], 400);
            return;
        }

        $result = $this->model->deleteTiene($cultivo, $epa);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Relación eliminada exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }
}
