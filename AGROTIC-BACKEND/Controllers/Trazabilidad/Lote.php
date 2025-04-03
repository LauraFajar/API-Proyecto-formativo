<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Lote extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getLotes() {
        $data = $this->model->selectLotes();
        jsonResponse($data, 200);
    }

    public function getLote($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectLote($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Lote no encontrado'], 404);
        }
    }

    public function createLote() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateLote($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $nombre_lote = $_POST['nombre_lote'];
        $descripcion = $_POST['descripcion'];

        $result = $this->model->insertLote($nombre_lote, $descripcion);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Lote creado exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function updateLote($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateLote($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $nombre_lote = $_POST['nombre_lote'];
        $descripcion = $_POST['descripcion'];

        $result = $this->model->updateLote($id, $nombre_lote, $descripcion);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Lote actualizado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function deleteLote($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteLote($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Lote eliminado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }
}