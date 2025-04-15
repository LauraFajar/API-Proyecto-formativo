<?php
class TieneModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectTienes(): ?array {
        try {
            $sql = "SELECT * FROM tiene";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectTienes: " . $e->getMessage());
            return null;
        }
    }

    public function selectTiene(int $id): ?array {
        try {
            $sql = "SELECT * FROM tiene WHERE id_tiene = ?";
            $result = $this->select($sql, [$id]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Error en selectTiene: " . $e->getMessage());
            return null;
        }
    }

    public function insertTiene(int $cultivo, int $epa): array {
        try {
            $sql = "INSERT INTO tiene (cultivo, epa) VALUES (?, ?)";
            $insertId = $this->insert($sql, [$cultivo, $epa]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertTiene: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al crear la relación'];
        }
    }

    public function updateTiene(int $id, int $cultivo, int $epa): array {
        try {
            $sql = "UPDATE tiene SET cultivo = ?, epa = ? WHERE id_tiene = ?";
            $result = $this->update($sql, [$cultivo, $epa, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Relación actualizada' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateTiene: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar la relación'];
        }
    }

    public function deleteTiene(int $cultivo, int $epa): array {
        try {
            $sql = "DELETE FROM tiene WHERE id_tiene = ?";
            $result = $this->delete($sql, [$cultivo, $epa]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Relación eliminada' : 'Relación no encontrada'];
        } catch (Exception $e) {
            error_log("Error en deleteTiene: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar la relación'];
        }
    }
}
