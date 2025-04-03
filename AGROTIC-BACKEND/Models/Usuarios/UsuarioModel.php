<?php
class UsuarioModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function insertUsuario($nombres, $email, $password, $tipo_documento, $numero_documento, $id_rol) {
        try {
            // Verificar si el email o número de documento ya existen
            $sqlCheck = "SELECT * FROM usuarios WHERE numero_documento = ? OR email = ?";
            $exists = $this->select($sqlCheck, [$numero_documento, $email]);

            if ($exists) {
                return ['status' => false, 'msg' => 'El número de documento o email ya existen en la base de datos'];
            }

            $sql = "INSERT INTO usuarios (nombres, email, password, tipo_documento, numero_documento, id_rol) VALUES (?, ?, ?, ?, ?, ?)";
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
            $sql = "SELECT u.id_usuarios, u.nombres, u.email, u.tipo_documento, u.numero_documento, nombre_rol AS rol
                    FROM usuarios u
                    INNER JOIN rol r ON u.id_rol = r.id_rol
                    WHERE u.email = ? AND u.password = ?";
            return $this->select($sql, [$email, $password]);
        } catch (Exception $e) {
            error_log("Error en loginUsuario: " . $e->getMessage());
            return false;
        }
    }

    public function getUsuario(int $id) {
        try {
            $sql = "SELECT u.id_usuarios, u.nombres, u.email, u.tipo_documento, u.numero_documento, u.id_rol
                    FROM usuarios u
                    WHERE u.id_usuarios = ?";
            return $this->select($sql, [$id]);
        } catch (Exception $e) {
            error_log("Error en getUsuario: " . $e->getMessage());
            return false;
        }
    }

    public function updateUsuario(int $id, string $nombres, string $email, string $tipo_documento, string $numero_documento, int $id_rol) {
        try {
            $sqlCheck = "SELECT id_usuarios FROM usuarios WHERE (numero_documento = ? OR email = ?) AND id_usuarios != ?";
            $exists = $this->select($sqlCheck, [$numero_documento, $email, $id]);

            if ($exists) {
                return ['status' => false, 'msg' => 'El número de documento o email ya están asignados a otro usuario'];
            }

            $sql = "UPDATE usuarios SET nombres = ?, email = ?, tipo_documento = ?, numero_documento = ?, id_rol = ? WHERE id_usuarios = ?";
            $affectedRows = $this->update($sql, [$nombres, $email, $tipo_documento, $numero_documento, $id_rol, $id]);
            return ['status' => true, 'affected_rows' => $affectedRows];
        } catch (Exception $e) {
            error_log("Error en updateUsuario: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar el usuario'];
        }
    }

    public function deleteUsuario(int $id) {
        try {
            $sql = "DELETE FROM usuarios WHERE id_usuarios = ?";
            $affectedRows = $this->delete($sql, [$id]);
            return ['status' => true, 'affected_rows' => $affectedRows];
        } catch (Exception $e) {
            error_log("Error en deleteUsuario: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar el usuario'];
        }
    }

    public function getUsuarios() {
        try {
            $sql = "SELECT u.id_usuarios, u.nombres, u.email, u.tipo_documento, u.numero_documento, nombre_rol AS rol
                    FROM usuarios u
                    INNER JOIN rol r ON u.id_rol = r.id_rol";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en getUsuarios: " . $e->getMessage());
            return [];
        }
    }
}