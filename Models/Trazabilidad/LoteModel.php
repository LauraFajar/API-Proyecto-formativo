<?php
class LoteModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectLotes(): ?array {
        try {
            $sql = "SELECT * FROM lotes";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectLotes: " . $e->getMessage());
            return null;
        }
    }

    public function selectLote(int $id): ?array {
        try {
            $sql = "SELECT * FROM lotes WHERE id_lote = ?";
            $result = $this->select($sql, [$id]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Error en selectLote: " . $e->getMessage());
            return null;
        }
    }

    public function insertLote(string $nombre_lote, string $descripcion): array {
        try {
            $sql = "INSERT INTO lotes (nombre_lote, descripcion) VALUES (?, ?)";
            $insertId = $this->insert($sql, [$nombre_lote, $descripcion]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertLote: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al crear el lote'];
        }
    }

    public function updateLote(int $id, string $nombre_lote, string $descripcion): array {
        try {
            $sql = "UPDATE lotes SET nombre_lote = ?, descripcion = ? WHERE id_lote = ?";
            $result = $this->update($sql, [$nombre_lote, $descripcion, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Lote actualizado' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateLote: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar el lote'];
        }
    }

    public function deleteLote(int $id): array {
        try {
            $sql = "DELETE FROM lotes WHERE id_lote = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Lote eliminado' : 'Lote no encontrado'];
        } catch (Exception $e) {
            error_log("Error en deleteLote: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar el lote'];
        }
    }
}