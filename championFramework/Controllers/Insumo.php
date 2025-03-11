<?php
class Insumo extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getInsumos() {
        $data = $this->model->selectInsumos();
        jsonResponse($data, 200);
    }

    public function getInsumo($id) {
        $data = $this->model->selectInsumo($id);
        jsonResponse($data, 200);
    }

    public function createInsumo() {
        $_POST = json_decode(file_get_contents('php://input'), true);
        if (isset($_POST['nombre_insumo']) && isset($_POST['codigo']) && isset($_POST['fecha_entrada']) && isset($_POST['observacion']) && isset($_POST['id_categoria']) && isset($_POST['id_almacen']) && isset($_POST['id_salida'])) {
            $nombre_insumo = $_POST['nombre_insumo'];
            $codigo = $_POST['codigo'];
            $fecha_entrada = $_POST['fecha_entrada'];
            $observacion = $_POST['observacion'];
            $id_categoria = $_POST['id_categoria'];
            $id_almacen = $_POST['id_almacen'];
            $id_salida = $_POST['id_salida'];

            $result = $this->model->insertInsumo($nombre_insumo, $codigo, $fecha_entrada, $observacion, $id_categoria, $id_almacen, $id_salida);
            if ($result['status']) {
                $data = array(
                    'status' => true,
                    'msg' => 'Insumo registrado exitosamente',
                    'id' => $result['id']
                );
                jsonResponse($data, 201);
            } else {
                jsonResponse(array('status' => false, 'msg' => 'Error al registrar el insumo'), 500);
            }
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Datos incompletos'), 400);
        }
    }

    public function updateInsumo($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);
        if (isset($_POST['nombre_insumo']) && isset($_POST['codigo']) && isset($_POST['fecha_entrada']) && isset($_POST['observacion']) && isset($_POST['id_categoria']) && isset($_POST['id_almacen']) && isset($_POST['id_salida'])) {
            $nombre_insumo = $_POST['nombre_insumo'];
            $codigo = $_POST['codigo'];
            $fecha_entrada = $_POST['fecha_entrada'];
            $observacion = $_POST['observacion'];
            $id_categoria = $_POST['id_categoria'];
            $id_almacen = $_POST['id_almacen'];
            $id_salida = $_POST['id_salida'];

            $result = $this->model->updateInsumo($id, $nombre_insumo, $codigo, $fecha_entrada, $observacion, $id_categoria, $id_almacen, $id_salida);
            if ($result['status']) {
                $data = array(
                    'status' => true,
                    'msg' => 'Insumo actualizado exitosamente',
                    'id' => $result['id']
                );
                jsonResponse($data, 200);
            } else {
                jsonResponse(array('status' => false, 'msg' => 'Error al actualizar el insumo'), 500);
            }
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Datos incompletos'), 400);
        }
    }

    public function deleteInsumo($id) {
        $result = $this->model->deleteInsumo($id);
        if ($result['status']) {
            $data = array(
                'status' => true,
                'msg' => 'Insumo eliminado exitosamente',
                'id' => $result['id']
            );
            jsonResponse($data, 200);
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Error al eliminar el insumo'), 500);
        }
    }
}