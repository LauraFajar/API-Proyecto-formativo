<?php
class ActividadModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectActividades(): ?array {
        try {
            $sql = "SELECT * FROM actividades";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectActividades: " . $e->getMessage());
            return null;
        }
    }

    public function selectActividad(int $id): ?array {
        try {
            $sql = "SELECT * FROM actividades WHERE id_actividad = ?";
            $result = $this->select($sql, [$id]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Error en selectActividad: " . $e->getMessage());
            return null;
        }
    }

    public function insertActividad(string $tipo_actividad, string $fecha, string $responsable, string $detalles, int $id_cultivo): array {
        try {
            $sql = "INSERT INTO actividades (tipo_actividad, fecha, responsable, detalles, id_cultivo) VALUES (?, ?, ?, ?, ?)";
            $insertId = $this->insert($sql, [$tipo_actividad, $fecha, $responsable, $detalles, $id_cultivo]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertActividad: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al insertar la actividad'];
        }
    }

    public function updateActividad(int $id, string $tipo_actividad = null, string $fecha = null, string $responsable = null, string $detalles = null, int $id_cultivo = null): array {
        try {
            $sql = "UPDATE actividades SET ";
            $params = [];
            $updates = [];

            if ($tipo_actividad !== null) {
                $updates[] = "tipo_actividad = ?";
                $params[] = $tipo_actividad;
            }
            if ($fecha !== null) {
                $updates[] = "fecha = ?";
                $params[] = $fecha;
            }
            if ($responsable !== null) {
                $updates[] = "responsable = ?";
                $params[] = $responsable;
            }
            if ($detalles !== null) {
                $updates[] = "detalles = ?";
                $params[] = $detalles;
            }
            if ($id_cultivo !== null) {
                $updates[] = "id_cultivo = ?";
                $params[] = $id_cultivo;
            }

            if (empty($updates)) {
                return ['status' => false, 'msg' => 'No hay campos para actualizar'];
            }

            $sql .= implode(', ', $updates) . " WHERE id_actividad = ?";
            $params[] = $id;

            $result = $this->update($sql, $params);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Actividad actualizada' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateActividad: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar la actividad'];
        }
    }

    public function deleteActividad(int $id): array {
        try {
            $sql = "DELETE FROM actividades WHERE id_actividad = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Actividad eliminada' : 'No se encontró la actividad'];
        } catch (Exception $e) {
            error_log("Error en deleteActividad: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar la actividad'];
        }
    }
}