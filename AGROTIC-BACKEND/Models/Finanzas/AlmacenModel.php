<?php
class AlmacenModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectAlmacenes() {
        try {
            $sql = "SELECT * FROM almacenes";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectAll: " . $e->getMessage());
            return false;
        }
    }

    public function selectAlmacen($id) {
        try {
            $sql = "SELECT * FROM almacenes WHERE id_almacen = ?";
            $result = $this->select($sql, [$id]);
            return $result ? $result : null; // Devuelve null si no encuentra el registro
        } catch (Exception $e) {
            error_log("Error en selectById: " . $e->getMessage());
            return null; // Devuelve null en caso de error
        }
    }

    public function insertAlmacen($nombre_almacen, $descripcion) {
        try {
            $sql = "INSERT INTO almacenes (nombre_almacen, descripcion) VALUES (?, ?)";
            $insertId = $this->insert($sql, [$nombre_almacen, $descripcion]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insert: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al insertar el almacén'];
        }   
    }

    public function updateAlmacen($id, $nombre_almacen, $descripcion) {
        try {
            $sql = "UPDATE almacenes SET nombre_almacen = ?, descripcion = ? WHERE id_almacen = ?";
            $result = $this->update($sql, [$nombre_almacen, $descripcion, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Almacén actualizado' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en update: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar el almacén'];
        }
    }

    public function deleteAlmacen($id): array {
        try {
            $sql = "DELETE FROM almacenes WHERE id_almacen = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Almacén eliminado' : 'No se encontró el almacén'];
        } catch (Exception $e) {
            error_log("Error en delete: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar el almacén'];
        }
    }
}