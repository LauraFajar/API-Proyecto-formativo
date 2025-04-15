<?php
class TipoRolModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectTipoRoles() {
        try {
            $sql = "SELECT * FROM tipoRol";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectTipoRoles: " . $e->getMessage());
            return false;
        }
    }

    public function selectTipoRol($id) {
        try {
            $sql = "SELECT * FROM tipoRol WHERE id_tipo_rol = ?";
            return $this->select($sql, [$id]);
        } catch (Exception $e) {
            error_log("Error en selectTipoRol: " . $e->getMessage());
            return false;
        }
    }

    public function insertTipoRol($descripcion) {
        try {
            $sql = "INSERT INTO tipoRol (descripcion) VALUES (?)";
            $insertId = $this->insert($sql, [$descripcion]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertTipoRol: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al registrar el tipo de rol'];
        }
    }

    public function updateTipoRol($id, $descripcion) {
        try {
            $sql = "UPDATE tipoRol SET descripcion = ? WHERE id_tipo_rol = ?";
            $result = $this->update($sql, [$descripcion, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Tipo de rol actualizado' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateTipoRol: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar el tipo de rol'];
        }
    }

    public function deleteTipoRol($id) {
        try {
            $sql = "DELETE FROM tipoRol WHERE id_tipo_rol = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Tipo de rol eliminado' : 'No se encontró el tipo de rol'];
        } catch (Exception $e) {
            error_log("Error en deleteTipoRol: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar el tipo de rol'];
        }
    }
}