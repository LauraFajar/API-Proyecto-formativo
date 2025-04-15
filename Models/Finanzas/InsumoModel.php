<?php
class InsumoModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectInsumos(): ?array {
        try {
            $sql = "SELECT * FROM insumos";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectInsumos: " . $e->getMessage());
            return null;
        }
    }

    public function selectInsumo(int $id): ?array {
        try {
            $sql = "SELECT * FROM insumos WHERE id_insumo = ?";
            $result = $this->select($sql, [$id]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Error en selectInsumo: " . $e->getMessage());
            return null;
        }
    }

    public function insertInsumo(string $nombre_insumo, string $codigo, string $fecha_entrada, string $observacion, int $id_categoria, int $id_almacen, ?int $id_salida): array {
        try {
            $sql = "INSERT INTO insumos (nombre_insumo, codigo, fecha_entrada, observacion, id_categoria, id_almacen, id_salida) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insertId = $this->insert($sql, [$nombre_insumo, $codigo, $fecha_entrada, $observacion, $id_categoria, $id_almacen, $id_salida]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertInsumo: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al insertar el insumo'];
        }
    }

    public function updateInsumo(int $id, string $nombre_insumo, string $codigo, string $fecha_entrada, string $observacion, int $id_categoria, int $id_almacen, ?int $id_salida): array {
        try {
            $sql = "UPDATE insumos SET nombre_insumo = ?, codigo = ?, fecha_entrada = ?, observacion = ?, id_categoria = ?, id_almacen = ?, id_salida = ? WHERE id_insumo = ?";
            $result = $this->update($sql, [$nombre_insumo, $codigo, $fecha_entrada, $observacion, $id_categoria, $id_almacen, $id_salida, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Insumo actualizado' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateInsumo: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar el insumo'];
        }
    }

    public function deleteInsumo(int $id): array {
        try {
            $sql = "DELETE FROM insumos WHERE id_insumo = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Insumo eliminado' : 'No se encontró el insumo'];
        } catch (Exception $e) {
            error_log("Error en deleteInsumo: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar el insumo'];
        }
    }
}