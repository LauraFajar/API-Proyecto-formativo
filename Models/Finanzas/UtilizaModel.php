<?php
class UtilizaModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectUtilizas(): ?array {
        try {
            $sql = "SELECT * FROM utiliza";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectUtilizas: " . $e->getMessage());
            return null;
        }
    }

    public function selectUtiliza(int $id): ?array {
        try {
            $sql = "SELECT * FROM utiliza WHERE id_utiliza = ?";
            $result = $this->select($sql, [$id]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Error en selectUtiliza: " . $e->getMessage());
            return null;
        }
    }

    public function insertUtiliza(int $id_actividades, int $id_insumos): array {
        try {
            $sql = "INSERT INTO utiliza (id_actividades, id_insumos) VALUES (?, ?)";
            $insertId = $this->insert($sql, [$id_actividades, $id_insumos]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertUtiliza: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al insertar la relación'];
        }
    }

    public function updateUtiliza(int $id, int $id_actividades, int $id_insumos): array {
        try {
            $sql = "UPDATE utiliza SET id_actividades = ?, id_insumos = ? WHERE id_utiliza = ?";
            $result = $this->update($sql, [$id_actividades, $id_insumos, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Relación actualizada' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateUtiliza: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar la relación'];
        }
    }

    public function deleteUtiliza(int $id): array {
        try {
            $sql = "DELETE FROM utiliza WHERE id_utiliza = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Relación eliminada' : 'No se encontró la relación'];
        } catch (Exception $e) {
            error_log("Error en deleteUtiliza: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar la relación'];
        }
    }
}