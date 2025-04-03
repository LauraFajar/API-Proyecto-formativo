<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Salida extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getSalidas() {
        $data = $this->model->selectSalidas();
        jsonResponse($data, 200);
    }

    public function getSalida($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectSalida($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Salida no encontrada'], 404);
        }
    }

    public function createSalida() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateSalida($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $nombre = $_POST['nombre'];
        $codigo = $_POST['codigo'];
        $cantidad = $_POST['cantidad'];
        $id_categorias = $_POST['id_categorias'];
        $id_almacenes = $_POST['id_almacenes'];
        $observacion = $_POST['observacion'];
        $fecha_salida = $_POST['fecha_salida'];

        if ($this->model === null) {
            error_log("Error: El modelo no está cargado.");
            jsonResponse(['status' => false, 'msg' => 'Error interno: modelo no cargado'], 500);
            return;
        }

        $result = $this->model->insertSalida($nombre, $codigo, $cantidad, $id_categorias, $id_almacenes, $observacion, $fecha_salida);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Salida registrada exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al registrar la salida'], 500);
        }
    }

    public function updateSalida($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateSalida($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $nombre = $_POST['nombre'];
        $codigo = $_POST['codigo'];
        $cantidad = $_POST['cantidad'];
        $id_categorias = $_POST['id_categorias'];
        $id_almacenes = $_POST['id_almacenes'];
        $observacion = $_POST['observacion'];
        $fecha_salida = $_POST['fecha_salida'];

        if ($this->model === null) {
            error_log("Error: El modelo no está cargado.");
            jsonResponse(['status' => false, 'msg' => 'Error interno: modelo no cargado'], 500);
            return;
        }

        $result = $this->model->updateSalida($id, $nombre, $codigo, $cantidad, $id_categorias, $id_almacenes, $observacion, $fecha_salida);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Salida actualizada exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al actualizar la salida'], 500);
        }
    }

    public function deleteSalida($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteSalida($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Salida eliminada exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al eliminar la salida'], 500);
        }
    }
}