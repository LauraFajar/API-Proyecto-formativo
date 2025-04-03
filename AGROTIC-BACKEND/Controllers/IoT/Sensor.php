<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Sensor extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getSensores()
    {
        $data = $this->model->selectSensores();
        jsonResponse($data, 200);
    }

    public function getSensor($id)
    {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $data = $this->model->selectSensor($id);
        if ($data) {
            jsonResponse($data, 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Sensor no encontrado'], 404);
        }
    }

    public function createSensor()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateSensor($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $tipo_sensor = $_POST['tipo_sensor'];
        $id_sublote = $_POST['id_sublote'];
        $estado = $_POST['estado'];

        $result = $this->model->insertSensor($tipo_sensor, $id_sublote, $estado);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Sensor registrado exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al registrar el sensor'], 500);
        }
    }

    public function updateSensor($id)
    {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $errors = Validator::validateSensor($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $tipo_sensor = $_POST['tipo_sensor'];
        $id_sublote = $_POST['id_sublote'];
        $estado = $_POST['estado'];

        $result = $this->model->updateSensor($id, $tipo_sensor, $id_sublote, $estado);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Sensor actualizado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al actualizar el sensor'], 500);
        }
    }

    public function deleteSensor($id)
    {
        if (!is_numeric($id)) {
            jsonResponse(['status' => false, 'msg' => 'ID inválido'], 400);
            return;
        }

        $result = $this->model->deleteSensor($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Sensor eliminado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Error al eliminar el sensor'], 500);
        }
    }
}

?>