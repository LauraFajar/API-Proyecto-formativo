<?php
class MovimientoModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectMovimientos(): ?array {
        try {
            $sql = "SELECT * FROM movimientos";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectMovimientos: " . $e->getMessage());
            return null;
        }
    }

    public function selectMovimiento(int $id): ?array {
        try {
            $sql = "SELECT * FROM movimientos WHERE id_movimiento = ?";
            $result = $this->select($sql, [$id]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Error en selectMovimiento: " . $e->getMessage());
            return null;
        }
    }

    public function insertMovimiento(string $tipo_movimiento, int $id_insumo, int $cantidad, string $unidad_medida, string $fecha_movimiento): array {
        try {
            $sql = "INSERT INTO movimientos (tipo_movimiento, id_insumo, cantidad, unidad_medida, fecha_movimiento) VALUES (?, ?, ?, ?, ?)";
            $insertId = $this->insert($sql, [$tipo_movimiento, $id_insumo, $cantidad, $unidad_medida, $fecha_movimiento]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertMovimiento: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al registrar el movimiento'];
        }
    }

    public function updateMovimiento(int $id, string $tipo_movimiento, int $id_insumo, int $cantidad, string $unidad_medida, string $fecha_movimiento): array {
        try {
            $sql = "UPDATE movimientos SET tipo_movimiento = ?, id_insumo = ?, cantidad = ?, unidad_medida = ?, fecha_movimiento = ? WHERE id_movimiento = ?";
            $result = $this->update($sql, [$tipo_movimiento, $id_insumo, $cantidad, $unidad_medida, $fecha_movimiento, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Movimiento actualizado' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateMovimiento: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar el movimiento'];
        }
    }

    public function deleteMovimiento(int $id): array {
        try {
            $sql = "DELETE FROM movimientos WHERE id_movimiento = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Movimiento eliminado' : 'Movimiento no encontrado'];
        } catch (Exception $e) {
            error_log("Error en deleteMovimiento: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar el movimiento'];
        }
    }
}