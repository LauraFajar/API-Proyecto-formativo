<?php
class EpaModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectEpas(): ?array {
        try {
            $sql = "SELECT * FROM epa";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectEpas: " . $e->getMessage());
            return null;
        }
    }

    public function selectEpa(int $id): ?array {
        try {
            $sql = "SELECT * FROM epa WHERE id_epa = ?";
            $result = $this->select($sql, [$id]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Error en selectEpa: " . $e->getMessage());
            return null;
        }
    }

    public function insertEpa(string $nombre_epa, string $descripcion): array {
        try {
            $sql = "INSERT INTO epa (nombre_epa, descripcion) VALUES (?, ?)";
            $insertId = $this->insert($sql, [$nombre_epa, $descripcion]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertEpa: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al registrar la EPA'];
        }
    }

    public function updateEpa(int $id, string $nombre_epa, string $descripcion): array {
        try {
            $sql = "UPDATE epa SET nombre_epa = ?, descripcion = ? WHERE id = ?";
            $result = $this->update($sql, [$nombre_epa, $descripcion, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'EPA actualizada' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateEpa: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar la EPA'];
        }
    }

    public function deleteEpa(int $id): array {
        try {
            $sql = "DELETE FROM epa WHERE id_epa = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'EPA eliminada' : 'No se encontró la EPA'];
        } catch (Exception $e) {
            error_log("Error en deleteEpa: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar la EPA'];
        }
    }
}