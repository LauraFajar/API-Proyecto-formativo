<?php
class InventarioModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectInventarios(): ?array {
        try {
            $sql = "SELECT * FROM inventario";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectInventarios: " . $e->getMessage());
            return null;
        }
    }

    public function selectInventario(int $id): ?array {
        try {
            $sql = "SELECT * FROM inventario WHERE id_inventario = ?";
            $result = $this->select($sql, [$id]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Error en selectInventario: " . $e->getMessage());
            return null;
        }
    }

    public function insertInventario(int $id_insumo, int $cantidad_stock, string $unidad_medida, ?string $fecha): array {
        try {
            $sql = "INSERT INTO inventario (id_insumo, cantidad_stock, unidad_medida, fecha) VALUES (?, ?, ?, ?)";
            $insertId = $this->insert($sql, [$id_insumo, $cantidad_stock, $unidad_medida, $fecha]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertInventario: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al crear el registro de inventario'];
        }
    }

    public function updateInventario(int $id, int $id_insumo, int $cantidad_stock, string $unidad_medida, ?string $fecha): array {
        try {
            $sql = "UPDATE inventario SET id_insumo = ?, cantidad_stock = ?, unidad_medida = ?, fecha = ? WHERE id_inventario = ?";
            $result = $this->update($sql, [$id_insumo, $cantidad_stock, $unidad_medida, $fecha, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Registro de inventario actualizado' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateInventario: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar el registro de inventario'];
        }
    }

    public function deleteInventario(int $id): array {
        try {
            $sql = "DELETE FROM inventario WHERE id_inventario = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Registro de inventario eliminado' : 'Registro de inventario no encontrado'];
        } catch (Exception $e) {
            error_log("Error en deleteInventario: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar el registro de inventario'];
        }
    }
}