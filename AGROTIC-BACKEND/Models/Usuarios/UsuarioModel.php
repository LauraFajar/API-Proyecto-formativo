<?php
class UsuarioModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function insertUsuario($nombres, $email, $password, $tipo_documento, $numero_documento, $id_rol) {
        try {
            // Verificar si el email o número de documento ya existen
            $sqlCheck = "SELECT * FROM usuario WHERE numero_documento = ? OR email = ?";
            $exists = $this->select($sqlCheck, [$numero_documento, $email]);

            if ($exists) {
                return ['status' => false, 'msg' => 'El número de documento o email ya existen en la base de datos'];
            }

            $sql = "INSERT INTO usuario (nombres, email, password, tipo_documento, numero_documento, id_rol) VALUES (?, ?, ?, ?, ?, ?)";
            $insertId = $this->insert($sql, [$nombres, $email, $password, $tipo_documento, $numero_documento, $id_rol]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertUsuario: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al registrar el usuario'];
        }
    }

    // Login de usuario
    public function loginUsuario($email, $password) {
        try {
            $sql = "SELECT u.id, u.nombres, u.email, u.tipo_documento, u.numero_documento, r.nombre AS rol
                    FROM usuario u
                    INNER JOIN rol r ON u.id_rol = r.id
                    WHERE u.email = ? AND u.password = ?";
            return $this->select($sql, [$email, $password]);
        } catch (Exception $e) {
            error_log("Error en loginUsuario: " . $e->getMessage());
            return false;
        }
    }
}