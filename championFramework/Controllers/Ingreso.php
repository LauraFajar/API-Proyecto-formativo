<?php
class Ingreso extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getIngresos() {
        $data = $this->model->selectIngresos();
        jsonResponse($data, 200);
    }

    public function getIngreso($id) {
        $data = $this->model->selectIngreso($id);
        jsonResponse($data, 200);
    }

    public function createIngreso() {
        $_POST = json_decode(file_get_contents('php://input'), true);
        if (isset($_POST['fecha_ingreso']) && isset($_POST['monto']) && isset($_POST['descripcion']) && isset($_POST['id_insumo'])) {
            $fecha_ingreso = $_POST['fecha_ingreso'];
            $monto = $_POST['monto'];
            $descripcion = $_POST['descripcion'];
            $id_insumo = $_POST['id_insumo'];

            $result = $this->model->insertIngreso($fecha_ingreso, $monto, $descripcion, $id_insumo);
            if ($result['status']) {
                $data = array(
                    'status' => true,
                    'msg' => 'Ingreso registrado exitosamente',
                    'id' => $result['id']
                );
                jsonResponse($data, 201);
            } else {
                jsonResponse(array('status' => false, 'msg' => 'Error al registrar el ingreso'), 500);
            }
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Datos incompletos'), 400);
        }
    }

    public function updateIngreso($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);
        if (isset($_POST['fecha_ingreso']) && isset($_POST['monto']) && isset($_POST['descripcion']) && isset($_POST['id_insumo'])) {
            $fecha_ingreso = $_POST['fecha_ingreso'];
            $monto = $_POST['monto'];
            $descripcion = $_POST['descripcion'];
            $id_insumo = $_POST['id_insumo'];

            $result = $this->model->updateIngreso($id, $fecha_ingreso, $monto, $descripcion, $id_insumo);
            if ($result['status']) {
                $data = array(
                    'status' => true,
                    'msg' => 'Ingreso actualizado exitosamente',
                    'id' => $result['id']
                );
                jsonResponse($data, 200);
            } else {
                jsonResponse(array('status' => false, 'msg' => 'Error al actualizar el ingreso'), 500);
            }
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Datos incompletos'), 400);
        }
    }

    public function deleteIngreso($id) {
        $result = $this->model->deleteIngreso($id);
        if ($result['status']) {
            $data = array(
                'status' => true,
                'msg' => 'Ingreso eliminado exitosamente',
                'id' => $result['id']
            );
            jsonResponse($data, 200);
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Error al eliminar el ingreso'), 500);
        }
    }
}