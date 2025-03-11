<?php
class Categoria extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getCategorias() {
        $data = $this->model->selectCategorias();
        jsonResponse($data, 200);
    }

    public function getCategoria($id) {
        $data = $this->model->selectCategoria($id);
        jsonResponse($data, 200);
    }

    public function createCategoria() {
        $_POST = json_decode(file_get_contents('php://input'), true);
        if (isset($_POST['nombre']) && isset($_POST['descripcion'])) {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            $result = $this->model->insertCategoria($nombre, $descripcion);
            if ($result['status']) {
                $data = array(
                    'status' => true,
                    'msg' => 'Categoría registrada exitosamente',
                    'id' => $result['id']
                );
                jsonResponse($data, 201);
            } else {
                jsonResponse(array('status' => false, 'msg' => 'Error al registrar la categoría'), 500);
            }
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Datos incompletos'), 400);
        }
    }

    public function updateCategoria($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);
        if (isset($_POST['nombre']) && isset($_POST['descripcion'])) {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            $result = $this->model->updateCategoria($id, $nombre, $descripcion);
            if ($result['status']) {
                $data = array(
                    'status' => true,
                    'msg' => 'Categoría actualizada exitosamente',
                    'id' => $result['id']
                );
                jsonResponse($data, 200);
            } else {
                jsonResponse(array('status' => false, 'msg' => 'Error al actualizar la categoría'), 500);
            }
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Datos incompletos'), 400);
        }
    }

    public function deleteCategoria($id) {
        $result = $this->model->deleteCategoria($id);
        if ($result['status']) {
            $data = array(
                'status' => true,
                'msg' => 'Categoría eliminada exitosamente',
                'id' => $result['id']
            );
            jsonResponse($data, 200);
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Error al eliminar la categoría'), 500);
        }
    }
}