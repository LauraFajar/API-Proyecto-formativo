<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Alerta extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAlertas()
    {
        $data = $this->model->selectAlertas();
        jsonResponse($data, 200);
    }

    public function getAlerta($id)
    {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectAlerta($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Alerta no encontrada'], 404);
        }
    }

    public function createAlerta()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateAlerta($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $tipo_alerta = $_POST['tipo_alerta'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $id_sensor = $_POST['id_sensor'];

        $result = $this->model->insertAlerta($tipo_alerta, $fecha, $hora, $id_sensor);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Alerta registrada exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al registrar la alerta'], 500);
        }
    }

    public function updateAlerta($id)
    {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateAlerta($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $tipo_alerta = $_POST['tipo_alerta'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $id_sensor = $_POST['id_sensor'];

        $result = $this->model->updateAlerta($id, $tipo_alerta, $fecha, $hora, $id_sensor);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Alerta actualizada exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al actualizar la alerta'], 500);
        }
    }

    public function deleteAlerta($id)
    {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteAlerta($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Alerta eliminada exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al eliminar la alerta'], 500);
        }
    }
}

?>