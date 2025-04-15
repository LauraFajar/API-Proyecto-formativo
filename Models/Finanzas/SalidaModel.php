<?php
class SalidaModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectSalidas(): ?array {
        try {
            $sql = "SELECT * FROM salidas";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectSalidas: " . $e->getMessage());
            return null;
        }
    }

    public function selectSalida(int $id): ?array {
        try {
            $sql = "SELECT * FROM salidas WHERE id_salida = ?";
            $result = $this->select($sql, [$id]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Error en selectSalida: " . $e->getMessage());
            return null;
        }
    }

    public function insertSalida(string $nombre, string $codigo, int $cantidad, int $id_categorias, int $id_almacenes, string $observacion, string $fecha_salida): array {
        try {
            $sql = "INSERT INTO salidas (nombre, codigo, cantidad, id_categorias, id_almacenes, observacion, fecha_salida) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insertId = $this->insert($sql, [$nombre, $codigo, $cantidad, $id_categorias, $id_almacenes, $observacion, $fecha_salida]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertSalida: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al insertar la salida'];
        }
    }

    public function updateSalida(int $id, string $nombre, string $codigo, int $cantidad, int $id_categorias, int $id_almacenes, string $observacion, string $fecha_salida): array {
        try {
            $sql = "UPDATE salidas SET nombre = ?, codigo = ?, cantidad = ?, id_categorias = ?, id_almacenes = ?, observacion = ?, fecha_salida = ? WHERE id_salida = ?";
            $result = $this->update($sql, [$nombre, $codigo, $cantidad, $id_categorias, $id_almacenes, $observacion, $fecha_salida, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Salida actualizada' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateSalida: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar la salida'];
        }
    }

    public function deleteSalida(int $id): array {
        try {
            $sql = "DELETE FROM salidas WHERE id_salida = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Salida eliminada' : 'No se encontró la salida'];
        } catch (Exception $e) {
            error_log("Error en deleteSalida: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar la salida'];
        }
    }
}