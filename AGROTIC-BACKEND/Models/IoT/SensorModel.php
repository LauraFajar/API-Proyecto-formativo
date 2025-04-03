<?php

class SensorModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectSensores(): ?array
    {
        try {
            $sql = "SELECT id_sensor, tipo_sensor, id_sublote, estado FROM sensores";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectSensores: " . $e->getMessage());
            return null;
        }
    }

    public function selectSensor(int $id): ?array
    {
        try {
            $sql = "SELECT id_sensor, tipo_sensor, id_sublote, estado FROM sensores WHERE id_sensor = ?";
            $result = $this->select($sql, [$id]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Error en selectSensor: " . $e->getMessage());
            return null;
        }
    }

    public function insertSensor(string $tipo_sensor, int $id_sublote, string $estado): array
    {
        try {
            $sql = "INSERT INTO sensores (tipo_sensor, id_sublote, estado) VALUES (?, ?, ?)";
            $insertId = $this->insert($sql, [$tipo_sensor, $id_sublote, $estado]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertSensor: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al insertar el sensor'];
        }
    }

    public function updateSensor(int $id, string $tipo_sensor, int $id_sublote, string $estado): array
    {
        try {
            $sql = "UPDATE sensores SET tipo_sensor = ?, id_sublote = ?, estado = ? WHERE id_sensor = ?";
            $result = $this->update($sql, [$tipo_sensor, $id_sublote, $estado, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Sensor actualizado' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateSensor: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar el sensor'];
        }
    }

    public function deleteSensor(int $id): array
    {
        try {
            $sql = "DELETE FROM sensores WHERE id_sensor = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Sensor eliminado' : 'Sensor no encontrado'];
        } catch (Exception $e) {
            error_log("Error en deleteSensor: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar el sensor'];
        }
    }
}