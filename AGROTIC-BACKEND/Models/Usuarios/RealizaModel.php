<?php
class RealizaModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectRealizas(): ?array {
        try {
            $sql = "SELECT * FROM realiza";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectRealizas: " . $e->getMessage());
            return null;
        }
    }

    public function selectRealiza(int $id): ?array {
        try {
            $sql = "SELECT * FROM realiza WHERE id_realiza = ?";
            $result = $this->select($sql, [$id]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Error en selectRealiza: " . $e->getMessage());
            return null;
        }
    }

    public function insertRealiza(int $usuario, int $actividad): array {
        try {
            $sql = "INSERT INTO realiza (usuario, actividad) VALUES (?, ?)";
            $insertId = $this->insert($sql, [$usuario, $actividad]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertRealiza: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al insertar la relación'];
        }
    }

    public function updateRealiza(int $id, int $usuario, int $actividad): array {
        try {
            $sql = "UPDATE realiza SET usuario = ?, actividad = ? WHERE id_realiza = ?";
            $result = $this->update($sql, [$usuario, $actividad, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Relación actualizada' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateRealiza: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar la relación'];
        }
    }

    public function deleteRealiza(int $id): array {
        try {
            $sql = "DELETE FROM realiza WHERE id_realiza = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Relación eliminada' : 'No se encontró la relación'];
        } catch (Exception $e) {
            error_log("Error en deleteRealiza: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar la relación'];
        }
    }
}