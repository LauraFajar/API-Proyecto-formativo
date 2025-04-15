<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Sublote extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getSublotes() {
        $data = $this->model->selectSublotes();
        jsonResponse($data, 200);
    }

    public function getSublote($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectSublote($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Sublote no encontrado'], 404);
        }
    }

    public function createSublote() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateSublote($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $descripcion = $_POST['descripcion'];
        $id_lote = $_POST['id_lote'];
        $ubicacion = $_POST['ubicacion'];

        $result = $this->model->insertSublote($descripcion, $id_lote, $ubicacion);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Sublote creado exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function updateSublote($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateSublote($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $descripcion = $_POST['descripcion'];
        $id_lote = $_POST['id_lote'];
        $ubicacion = $_POST['ubicacion'];

        $result = $this->model->updateSublote($id, $descripcion, $id_lote, $ubicacion);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Sublote actualizado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function deleteSublote($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteSublote($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Sublote eliminado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }
}