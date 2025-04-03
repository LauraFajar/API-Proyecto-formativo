<?php
class RolModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectRoles() {
        try {
            $sql = "SELECT * FROM rol";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectRoles: " . $e->getMessage());
            return false;
        }
    }

    public function selectRol($id) {
        try {
            $sql = "SELECT * FROM rol WHERE id_rol = ?";
            return $this->select($sql, [$id]);
        } catch (Exception $e) {
            error_log("Error en selectRol: " . $e->getMessage());
            return false;
        }
    }

    public function insertRol($nombre_rol, $id_tipo_rol) {
        try {
            $sql = "INSERT INTO rol (nombre_rol, id_tipo_rol) VALUES (?, ?)";
            $insertId = $this->insert($sql, [$nombre_rol, $id_tipo_rol]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertRol: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al registrar el rol'];
        }
    }

    public function updateRol($id, $nombre_rol, $id_tipo_rol) {
        try {
            $sql = "UPDATE rol SET nombre_rol = ?, id_tipo_rol = ? WHERE id = ?";
            $result = $this->update($sql, [$nombre_rol, $id_tipo_rol, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Rol actualizado' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateRol: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar el rol'];
        }
    }

    public function deleteRol($id) {
        try {
            $sql = "DELETE FROM rol WHERE id_rol = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Rol eliminado' : 'No se encontró el rol'];
        } catch (Exception $e) {
            error_log("Error en deleteRol: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar el rol'];
        }
    }
}