<?php
class CultivoModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectCultivos(): ?array {
        try {
            $sql = "SELECT * FROM cultivos";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectCultivos: " . $e->getMessage());
            return null;
        }
    }

    public function selectCultivo(int $id): ?array {
        try {
            $sql = "SELECT * FROM cultivos WHERE id_cultivo = ?";
            $result = $this->select($sql, [$id]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Error en selectCultivo: " . $e->getMessage());
            return null;
        }
    }

    public function insertCultivo(string $tipo_cultivo, int $id_lote, int $id_insumo): array {
        try {
            $sql = "INSERT INTO cultivos (tipo_cultivo, id_lote, id_insumo) VALUES (?, ?, ?)";
            $insertId = $this->insert($sql, [$tipo_cultivo, $id_lote, $id_insumo]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertCultivo: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al crear el cultivo'];
        }
    }

    public function updateCultivo(int $id, string $tipo_cultivo, int $id_lote, int $id_insumo): array {
        try {
            $sql = "UPDATE cultivos SET tipo_cultivo = ?, id_lote = ?, id_insumo = ? WHERE id_cultivo = ?";
            $result = $this->update($sql, [$tipo_cultivo, $id_lote, $id_insumo, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Cultivo actualizado' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateCultivo: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar el cultivo'];
        }
    }

    public function deleteCultivo(int $id): array {
        try {
            $sql = "DELETE FROM cultivos WHERE id_cultivo = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Cultivo eliminado' : 'Cultivo no encontrado'];
        } catch (Exception $e) {
            error_log("Error en deleteCultivo: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar el cultivo'];
        }
    }
}