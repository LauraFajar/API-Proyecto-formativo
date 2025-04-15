<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Insumo extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getInsumos() {
        $data = $this->model->selectInsumos();
        jsonResponse($data, 200);
    }

    public function getInsumo($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectInsumo($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Insumo no encontrado'], 404);
        }
    }

    public function createInsumo() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        // Validar datos
        $errors = Validator::validateInsumo($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        // Procesar datos si no hay errores
        $nombre_insumo = $_POST['nombre_insumo'];
        $codigo = $_POST['codigo'];
        $fecha_entrada = $_POST['fecha_entrada'];
        $observacion = $_POST['observacion'];
        $id_categoria = $_POST['id_categoria'];
        $id_almacen = $_POST['id_almacen'];
        $id_salida = $_POST['id_salida'];

        // Depuración: Verificar si el modelo está cargado
        if ($this->model === null) {
            error_log("Error: El modelo no está cargado.");
            jsonResponse(['status' => false, 'msg' => 'Error interno: modelo no cargado'], 500);
            return;
        }

        $result = $this->model->insertInsumo($nombre_insumo, $codigo, $fecha_entrada, $observacion, $id_categoria, $id_almacen, $id_salida);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Insumo registrado exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al registrar el insumo'], 500);
        }
    }

    public function updateInsumo($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateInsumo($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $nombre_insumo = $_POST['nombre_insumo'];
        $codigo = $_POST['codigo'];
        $fecha_entrada = $_POST['fecha_entrada'];
        $observacion = $_POST['observacion'];
        $id_categoria = $_POST['id_categoria'];
        $id_almacen = $_POST['id_almacen'];
        $id_salida = $_POST['id_salida'];

        if ($this->model === null) {
            error_log("Error: El modelo no está cargado.");
            jsonResponse(['status' => false, 'msg' => 'Error interno: modelo no cargado'], 500);
            return;
        }

        $result = $this->model->updateInsumo($id, $nombre_insumo, $codigo, $fecha_entrada, $observacion, $id_categoria, $id_almacen, $id_salida);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Insumo actualizado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al actualizar el insumo'], 500);
        }
    }

    public function deleteInsumo($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteInsumo($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Insumo eliminado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al eliminar el insumo'], 500);
        }
    }
}