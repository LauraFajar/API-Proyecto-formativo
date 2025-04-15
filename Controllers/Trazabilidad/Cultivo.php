<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Cultivo extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getCultivos() {
        $data = $this->model->selectCultivos();
        jsonResponse($data, 200);
    }

    public function getCultivo($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectCultivo($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Cultivo no encontrado'], 404);
        }
    }

    public function createCultivo() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateCultivo($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $tipo_cultivo = $_POST['tipo_cultivo'];
        $id_lote = $_POST['id_lote'];
        $id_insumo = $_POST['id_insumo'];

        $result = $this->model->insertCultivo($tipo_cultivo, $id_lote, $id_insumo);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Cultivo creado exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function updateCultivo($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateCultivo($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $tipo_cultivo = $_POST['tipo_cultivo'];
        $id_lote = $_POST['id_lote'];
        $id_insumo = $_POST['id_insumo'];

        $result = $this->model->updateCultivo($id, $tipo_cultivo, $id_lote, $id_insumo);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Cultivo actualizado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function deleteCultivo($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteCultivo($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Cultivo eliminado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }
}