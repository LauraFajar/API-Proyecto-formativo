<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Movimiento extends Controllers {

    public function __construct() {
        parent::__construct();
        $this->model = new MovimientoModel();
    }

    public function getMovimientos() {
        $data = $this->model->selectMovimientos();
        jsonResponse($data, 200);
    }

    public function getMovimiento($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectMovimiento($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Movimiento no encontrado'], 404);
        }
    }

    public function createMovimiento() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateMovimiento($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $tipo_movimiento = $_POST['tipo_movimiento'];
        $id_insumo = $_POST['id_insumo'];
        $cantidad = $_POST['cantidad'];
        $unidad_medida = $_POST['unidad_medida'];
        $fecha_movimiento = $_POST['fecha_movimiento'];

        $result = $this->model->insertMovimiento($tipo_movimiento, $id_insumo, $cantidad, $unidad_medida, $fecha_movimiento);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Movimiento registrado exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function updateMovimiento($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateMovimiento($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $tipo_movimiento = $_POST['tipo_movimiento'];
        $id_insumo = $_POST['id_insumo'];
        $cantidad = $_POST['cantidad'];
        $unidad_medida = $_POST['unidad_medida'];
        $fecha_movimiento = $_POST['fecha_movimiento'];

        $result = $this->model->updateMovimiento($id, $tipo_movimiento, $id_insumo, $cantidad, $unidad_medida, $fecha_movimiento);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Movimiento actualizado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function deleteMovimiento($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteMovimiento($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Movimiento eliminado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }
}