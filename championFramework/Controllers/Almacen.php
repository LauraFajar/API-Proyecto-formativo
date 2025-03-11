<?php
class Almacen extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getAlmacenes() {
        $data = $this->model->selectAlmacenes();
        jsonResponse($data, 200);
    }

    public function getAlmacen($id) {
        $data = $this->model->selectAlmacen($id);
        jsonResponse($data, 200);
    }

    public function createAlmacen() {
        $_POST = json_decode(file_get_contents('php://input'), true);
        if (isset($_POST['nombre_almacen']) && isset($_POST['descripcion'])) {
            $nombre = $_POST['nombre_almacen'];
            $descripcion = $_POST['descripcion'];

            // Mensaje de depuración
            error_log("Datos recibidos: nombre_almacen = $nombre, descripcion = $descripcion");

            $result = $this->model->insertAlmacen($nombre, $descripcion);
            if ($result['status']) {
                $data = array(
                    'status' => true,
                    'msg' => 'Almacen registrado exitosamente',
                    'id' => $result['id']
                );
                jsonResponse($data, 201);
            } else {
                jsonResponse(array('status' => false, 'msg' => 'Error al registrar el almacen'), 500);
            }
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Datos incompletos'), 400);
        }
    }

    public function updateAlmacen($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);
        if (isset($_POST['nombre_almacen']) && isset($_POST['descripcion'])) {
            $nombre = $_POST['nombre_almacen'];
            $descripcion = $_POST['descripcion'];

            // Mensaje de depuración
            error_log("Datos recibidos para actualizar: id = $id, nombre_almacen = $nombre, descripcion = $descripcion");

            $result = $this->model->updateAlmacen($id, $nombre, $descripcion);
            if ($result['status']) {
                $data = array(
                    'status' => true,
                    'msg' => 'Almacen actualizado exitosamente',
                    'id' => $result['id']
                );
                jsonResponse($data, 200);
            } else {
                jsonResponse(array('status' => false, 'msg' => 'Error al actualizar el almacen'), 500);
            }
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Datos incompletos'), 400);
        }
    }

    public function deleteAlmacen($id) {
        $result = $this->model->deleteAlmacen($id);
        if ($result['status']) {
            $data = array(
                'status' => true,
                'msg' => 'Almacen eliminado exitosamente',
                'id' => $result['id']
            );
            jsonResponse($data, 200);
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Error al eliminar el almacen'), 500);
        }
    }
}