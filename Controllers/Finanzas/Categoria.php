<?php

require_once __DIR__ . "/../../Helpers/Validator.php";

class Categoria extends Controllers {
    public function __construct() {
        parent::__construct();
    }

    public function getCategorias() {
        $data = $this->model->selectCategorias();
        jsonResponse($data, 200);
    }

    public function getCategoria($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectCategoria($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Categoría no encontrada'], 404);
        }
    }

    public function createCategoria() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        // Validar datos
        $errors = Validator::validateCategoria($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        // Procesar datos si no hay errores
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        // Depuración: Verificar si el modelo está cargado
        if ($this->model === null) {
            error_log("Error: El modelo no está cargado.");
            jsonResponse(['status' => false, 'msg' => 'Error interno: modelo no cargado'], 500);
            return;
        }

        $result = $this->model->insertCategoria($nombre, $descripcion);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Categoría registrada exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al registrar la categoría'], 500);
        }
    }

    public function updateCategoria($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        if (isset($_POST['nombre']) && isset($_POST['descripcion'])) {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            error_log("Datos recibidos para actualizar: id = $id, nombre = $nombre, descripcion = $descripcion");

            $result = $this->model->updateCategoria($id, $nombre, $descripcion);
            if ($result['status']) {
                jsonResponse(['status' => true, 'msg' => 'Categoría actualizada exitosamente'], 200);
            } else {
                jsonResponse(['status' => false, 'msg' => 'Error al actualizar la categoría'], 500);
            }
        } else {
            jsonResponse(['status' => false, 'msg' => 'Datos incompletos'], 400);
        }
    }

    public function deleteCategoria($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteCategoria($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Categoría eliminada exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al eliminar la categoría'], 500);
        }
    }
}