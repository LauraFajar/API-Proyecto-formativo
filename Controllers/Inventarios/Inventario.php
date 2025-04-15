<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Inventario extends Controllers {

    public function __construct() {
        parent::__construct();
        $this->model = new InventarioModel();
    }

    public function getInventarios() {
        $data = $this->model->selectInventarios();
        jsonResponse($data, 200);
    }

    public function getInventario($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectInventario($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Registro de inventario no encontrado'], 404);
        }
    }

    public function createInventario() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateInventario($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $id_insumo = $_POST['id_insumo'];
        $cantidad_stock = $_POST['cantidad_stock'];
        $unidad_medida = $_POST['unidad_medida'];
        $fecha = $_POST['fecha'];

        $result = $this->model->insertInventario($id_insumo, $cantidad_stock, $unidad_medida, $fecha);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Registro de inventario creado exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function updateInventario($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateInventario($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $id_insumo = $_POST['id_insumo'];
        $cantidad_stock = $_POST['cantidad_stock'];
        $unidad_medida = $_POST['unidad_medida'];
        $fecha = $_POST['fecha'];

        $result = $this->model->updateInventario($id, $id_insumo, $cantidad_stock, $unidad_medida, $fecha);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Registro de inventario actualizado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function deleteInventario($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteInventario($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Registro de inventario eliminado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }
}