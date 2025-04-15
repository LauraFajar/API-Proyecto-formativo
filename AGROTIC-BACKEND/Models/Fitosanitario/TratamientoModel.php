<?php
class TratamientoModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectTratamientos(): ?array {
        try {
            $sql = "SELECT * FROM tratamientos";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectTratamientos: " . $e->getMessage());
            return null;
        }
    }

    public function selectTratamiento(int $id): ?array {
        try {
            $sql = "SELECT * FROM tratamientos WHERE id_tratamiento = ?";
            $result = $this->select($sql, [$id]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Error en selectTratamiento: " . $e->getMessage());
            return null;
        }
    }

    public function insertTratamiento(string $descripcion, string $dosis, string $frecuencia, int $id_epa): array {
        try {
            $sql = "INSERT INTO tratamientos (descripcion, dosis, frecuencia, id_epa) VALUES (?, ?, ?, ?)";
            $insertId = $this->insert($sql, [$descripcion, $dosis, $frecuencia, $id_epa]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertTratamiento: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al crear el tratamiento'];
        }
    }

    public function updateTratamiento(int $id, string $descripcion, string $dosis, string $frecuencia, int $id_epa): array {
        try {
            $sql = "UPDATE tratamientos SET descripcion = ?, dosis = ?, frecuencia = ?, id_epa = ? WHERE id_tratamiento = ?";
            $result = $this->update($sql, [$descripcion, $dosis, $frecuencia, $id_epa, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Tratamiento actualizado' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateTratamiento: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar el tratamiento'];
        }
    }

    public function deleteTratamiento(int $id): array {
        try {
            $sql = "DELETE FROM tratamientos WHERE id_tratamiento = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Tratamiento eliminado' : 'Tratamiento no encontrado'];
        } catch (Exception $e) {
            error_log("Error en deleteTratamiento: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar el tratamiento'];
        }
    }
}