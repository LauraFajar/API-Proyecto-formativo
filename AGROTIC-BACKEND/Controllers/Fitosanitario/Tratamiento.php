<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Tratamiento extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function getTratamientos() {
        $data = $this->model->selectTratamientos();
        jsonResponse($data, 200);
    }

    public function getTratamiento($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectTratamiento($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Tratamiento no encontrado'], 404);
        }
    }

    public function createTratamiento() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateTratamiento($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $descripcion = $_POST['descripcion'];
        $dosis = $_POST['dosis'];
        $frecuencia = $_POST['frecuencia'];
        $id_epa = $_POST['id_epa'];

        $result = $this->model->insertTratamiento($descripcion, $dosis, $frecuencia, $id_epa);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Tratamiento creado exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function updateTratamiento($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateTratamiento($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $descripcion = $_POST['descripcion'];
        $dosis = $_POST['dosis'];
        $frecuencia = $_POST['frecuencia'];
        $id_epa = $_POST['id_epa'];

        $result = $this->model->updateTratamiento($id, $descripcion, $dosis, $frecuencia, $id_epa);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Tratamiento actualizado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function deleteTratamiento($id) {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteTratamiento($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Tratamiento eliminado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }
}