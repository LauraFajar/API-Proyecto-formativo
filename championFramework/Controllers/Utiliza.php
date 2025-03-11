<?php
class Utiliza extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getUtilizas() {
        $data = $this->model->selectUtilizas();
        jsonResponse($data, 200);
    }

    public function getUtiliza($id) {
        $data = $this->model->selectUtiliza($id);
        jsonResponse($data, 200);
    }

    public function createUtiliza() {
        $_POST = json_decode(file_get_contents('php://input'), true);
        if (isset($_POST['id_actividades']) && isset($_POST['id_insumos'])) {
            $id_actividades = $_POST['id_actividades'];
            $id_insumos = $_POST['id_insumos'];

            $result = $this->model->insertUtiliza($id_actividades, $id_insumos);
            if ($result['status']) {
                $data = array(
                    'status' => true,
                    'msg' => 'Relación registrada exitosamente',
                    'id' => $result['id']
                );
                jsonResponse($data, 201);
            } else {
                jsonResponse(array('status' => false, 'msg' => 'Error al registrar la relación'), 500);
            }
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Datos incompletos'), 400);
        }
    }

    public function updateUtiliza($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);
        if (isset($_POST['id_actividades']) && isset($_POST['id_insumos'])) {
            $id_actividades = $_POST['id_actividades'];
            $id_insumos = $_POST['id_insumos'];

            $result = $this->model->updateUtiliza($id, $id_actividades, $id_insumos);
            if ($result['status']) {
                $data = array(
                    'status' => true,
                    'msg' => 'Relación actualizada exitosamente',
                    'id' => $result['id']
                );
                jsonResponse($data, 200);
            } else {
                jsonResponse(array('status' => false, 'msg' => 'Error al actualizar la relación'), 500);
            }
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Datos incompletos'), 400);
        }
    }

    public function deleteUtiliza($id) {
        $result = $this->model->deleteUtiliza($id);
        if ($result['status']) {
            $data = array(
                'status' => true,
                'msg' => 'Relación eliminada exitosamente',
                'id' => $result['id']
            );
            jsonResponse($data, 200);
        } else {
            jsonResponse(array('status' => false, 'msg' => 'Error al eliminar la relación'), 500);
        }
    }
}