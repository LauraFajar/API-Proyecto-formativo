<?php
class IngresoModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectIngresos() {
        try {
            $sql = "SELECT * FROM ingresos";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectAll: " . $e->getMessage());
            return null;
        }
    }

    public function selectIngreso(int $id) {
        try {
            $sql = "SELECT * FROM ingresos WHERE id_ingreso = ?";
            $result = $this->select($sql, [$id]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Error en selectById: " . $e->getMessage());
            return null;
        }
    }

    public function insertIngreso(string $fecha_ingreso, float $monto, string $descripcion, int $id_insumo): array {
        try {
            $sql = "INSERT INTO ingresos (fecha_ingreso, monto, descripcion, id_insumo) VALUES (?, ?, ?, ?)";
            $arrData = [$fecha_ingreso, $monto, $descripcion, $id_insumo];
            $insertId = $this->insert($sql, $arrData);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insert: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al insertar el ingreso'];
        }
    }

    public function updateIngreso(int $id, string $fecha_ingreso, float $monto, string $descripcion, int $id_insumo): array {
        try {
            $sql = "UPDATE ingresos SET fecha_ingreso = ?, monto = ?, descripcion = ?, id_insumo = ? WHERE id_ingreso = ?";
            $arrData = [$fecha_ingreso, $monto, $descripcion, $id_insumo, $id];
            $result = $this->update($sql, $arrData);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Ingreso actualizado' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en update: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar el ingreso'];
        }
    }

    public function deleteIngreso(int $id): array {
        try {
            $sql = "DELETE FROM ingresos WHERE id_ingreso = ?";
            $arrData = [$id];
            $result = $this->delete($sql, $arrData);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Ingreso eliminado' : 'No se encontró el ingreso'];
        } catch (Exception $e) {
            error_log("Error en delete: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar el ingreso'];
        }
    }
}