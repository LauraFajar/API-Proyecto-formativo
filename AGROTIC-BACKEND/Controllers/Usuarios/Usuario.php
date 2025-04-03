<?php
require_once __DIR__ . "/../../Helpers/Validator.php";

class Usuario extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    // Registro de usuarios
    public function registro() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $errors = Validator::validateUsuario($_POST);
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $nombres = ucwords(strtolower($_POST['nombres']));
        $email = strtolower($_POST['email']);
        $password = hash('sha256', $_POST['password']);
        $tipo_documento = $_POST['tipo_documento'];
        $numero_documento = $_POST['numero_documento'];
        $id_rol = $_POST['id_rol'];

        if ($this->model === null) {
            error_log("Error: El modelo no está cargado.");
            jsonResponse(['status' => false, 'msg' => 'Error interno: modelo no cargado'], 500);
            return;
        }

        $result = $this->model->insertUsuario($nombres, $email, $password, $tipo_documento, $numero_documento, $id_rol);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Usuario registrado exitosamente', 'id' => $result['id']], 201);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    // Login de usuarios
    public function login() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        if (empty($_POST['email']) || empty($_POST['password'])) {
            jsonResponse(['status' => false, 'msg' => 'El email y la contraseña son obligatorios'], 400);
            return;
        }

        $email = strtolower($_POST['email']);
        $password = hash('sha256', $_POST['password']); // Hashear la contraseña 

        $result = $this->model->loginUsuario($email, $password);
        if ($result) {
            jsonResponse(['status' => true, 'msg' => 'Login exitoso', 'data' => $result], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Credenciales incorrectas'], 401);
        }
    }
    
    public function getUsuario(int $id) {
        $usuario = $this->model->getUsuario($id);
        if ($usuario) {
            jsonResponse(['status' => true, 'data' => $usuario], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => 'Usuario no encontrado'], 404);
        }
    }

    public function updateUsuario(int $id) {
        $_POST = json_decode(file_get_contents('php://input'), true);
        $errors = Validator::validateUsuario($_POST, true); 
        if (!empty($errors)) {
            jsonResponse(['status' => false, 'errors' => $errors], 400);
            return;
        }

        $nombres = ucwords(strtolower($_POST['nombres']));
        $email = strtolower($_POST['email']);
        $tipo_documento = $_POST['tipo_documento'];
        $numero_documento = $_POST['numero_documento'];
        $id_rol = $_POST['id_rol'];

        $result = $this->model->updateUsuario($id, $nombres, $email, $tipo_documento, $numero_documento, $id_rol);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Usuario actualizado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function deleteUsuario(int $id) {
        $result = $this->model->deleteUsuario($id);
        if ($result['status']) {
            jsonResponse(['status' => true, 'msg' => 'Usuario eliminado exitosamente'], 200);
        } else {
            jsonResponse(['status' => false, 'msg' => $result['msg']], 500);
        }
    }

    public function getUsuarios() {
        $usuarios = $this->model->getUsuarios();
        jsonResponse(['status' => true, 'data' => $usuarios], 200);
    }
}