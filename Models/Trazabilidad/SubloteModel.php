<?php
class SubloteModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectSublotes(): ?array {
        try {
            $sql = "SELECT * FROM sublotes";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectSublotes: " . $e->getMessage());
            return null;
        }
    }

    public function selectSublote(int $id): ?array {
        try {
            $sql = "SELECT * FROM sublotes WHERE id_sublote = ?";
            $result = $this->select($sql, [$id]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Error en selectSublote: " . $e->getMessage());
            return null;
        }
    }

    public function insertSublote(string $descripcion, int $id_lote, string $ubicacion): array {
        try {
            $sql = "INSERT INTO sublotes (descripcion, id_lote, ubicacion) VALUES (?, ?, ?)";
            $insertId = $this->insert($sql, [$descripcion, $id_lote, $ubicacion]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertSublote: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al crear el sublote'];
        }
    }

    public function updateSublote(int $id, string $descripcion, int $id_lote, string $ubicacion): array {
        try {
            $sql = "UPDATE sublotes SET descripcion = ?, id_lote = ?, ubicacion = ? WHERE id_sublote = ?";
            $result = $this->update($sql, [$descripcion, $id_lote, $ubicacion, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Sublote actualizado' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateSublote: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar el sublote'];
        }
    }

    public function deleteSublote(int $id): array {
        try {
            $sql = "DELETE FROM sublotes WHERE id_sublote = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Sublote eliminado' : 'Sublote no encontrado'];
        } catch (Exception $e) {
            error_log("Error en deleteSublote: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar el sublote'];
        }
    }
}