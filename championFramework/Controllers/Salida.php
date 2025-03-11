<?php
class Salida extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getSalidas() {
        $data = $this->model->selectSalidas();
        jsonResponse($data, 200);
    }

    public function getSalida($id) {
        $data = $this->model->selectSalida($id);
        jsonResponse($data, 200);
    }

    public function createSalida() {
        $_POST = json_decode(file_get_contents('php://input'), true);
        if (isset($_POST['nombre']) && isset($_POST['codigo']) && isset($_POST['cantidad']) && isset($_POST['observacion']) && isset($_POST['fecha_salida']) && isset($_POST['id_categoria']) && isset($_POST['id_almacen'])) {
            $nombre = $_POST['nombre'];
            $codigo = $_POST['codigo'];
            $cantidad = $_POST['cantidad'];
            $observacion = $_POST['observacion'];
            $fecha_salida = $_POST['fecha_salida'];
            $id_categoria = $_POST['id_categoria'];
            $id_almacen = $_POST['id_almacen'];

            $result = $this->model->insertSalida($nombre, $codigo, $cantidad, $observacion, $fecha_salida, $id_categoria, $id_almacen);
            if ($result['status']) {
                $data = array(
                    'status' => true,
                    'msg' => 'Salida registrada exitosamente',
                    'id' => $result['id']
                );
                jsonResponse($data, 201);
            } else {
                jsonResponse(array('status' => false, 'msg' => 'Error al registrar la salida'), 500);
            }
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Datos incompletos'), 400);
        }
    }

    public function updateSalida($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);
        if (isset($_POST['nombre']) && isset($_POST['codigo']) && isset($_POST['cantidad']) && isset($_POST['observacion']) && isset($_POST['fecha_salida']) && isset($_POST['id_categoria']) && isset($_POST['id_almacen'])) {
            $nombre = $_POST['nombre'];
            $codigo = $_POST['codigo'];
            $cantidad = $_POST['cantidad'];
            $observacion = $_POST['observacion'];
            $fecha_salida = $_POST['fecha_salida'];
            $id_categoria = $_POST['id_categoria'];
            $id_almacen = $_POST['id_almacen'];

            $result = $this->model->updateSalida($id, $nombre, $codigo, $cantidad, $observacion, $fecha_salida, $id_categoria, $id_almacen);
            if ($result['status']) {
                $data = array(
                    'status' => true,
                    'msg' => 'Salida actualizada exitosamente',
                    'id' => $result['id']
                );
                jsonResponse($data, 200);
            } else {
                jsonResponse(array('status' => false, 'msg' => 'Error al actualizar la salida'), 500);
            }
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Datos incompletos'), 400);
        }
    }

    public function deleteSalida($id) {
        $result = $this->model->deleteSalida($id);
        if ($result['status']) {
            $data = array(
                'status' => true,
                'msg' => 'Salida eliminada exitosamente',
                'id' => $result['id']
            );
            jsonResponse($data, 200);
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Error al eliminar la salida'), 500);
        }
    }
}