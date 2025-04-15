<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Almacen extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getAlmacenes() {
        $data = $this->model->selectAlmacenes();
        jsonResponse($data, 200);
    }

    public function getAlmacen($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }
    
        $data = $this->model->selectAlmacen($id);
    
        // Agrega un log para depuración
        error_log("Resultado de selectAlmacen: " . print_r($data, true));
    
        if (is_array($data)) {
            jsonResponse($data, 200); // Devuelve los datos del almacén
        } elseif ($data === null) {
            jsonResponse(['status' => false, 'msg' => 'Almacén no encontrado'], 404);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al consultar el almacén'], 500);
        }
    }

    public function createAlmacen() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        // Validar datos
        $errors = Validator::validateAlmacen($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        // Procesar datos si no hay errores
        $nombre = $_POST['nombre_almacen'];
        $descripcion = $_POST['descripcion'];

        $result = $this->model->insertAlmacen($nombre, $descripcion);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Almacén registrado exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al registrar el almacén'], 500);
        }
    }

    public function updateAlmacen($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        if (isset($_POST['nombre_almacen']) && isset($_POST['descripcion'])) {
            $nombre = $_POST['nombre_almacen'];
            $descripcion = $_POST['descripcion'];

            // Mensaje de depuración
            error_log("Datos recibidos para actualizar: id = $id, nombre_almacen = $nombre, descripcion = $descripcion");

            $result = $this->model->updateAlmacen($id, $nombre, $descripcion);
            if ($result['status']) {
                jsonResponse(['status' => true, 'msg' => 'Almacén actualizado exitosamente'], 200);
            } else {
                jsonResponse(['status' => false, 'msg' => 'Error al actualizar el almacén'], 500);
            }
        } else {
            jsonResponse(['status' => false, 'msg' => 'Datos incompletos'], 400);
        }
    }

    public function deleteAlmacen($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteAlmacen($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Almacén eliminado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al eliminar el almacén'], 500);
        }
    }
}