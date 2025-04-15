<?php

class AlertaModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectAlertas(): ?array
    {
        try {
            $sql = "SELECT id_alerta, tipo_alerta, fecha, hora, id_sensor FROM alertas";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectAlertas: " . $e->getMessage());
            return null;
        }
    }

    public function selectAlerta(int $id): ?array
    {
        try {
            $sql = "SELECT id_alerta, tipo_alerta, fecha, hora, id_sensor FROM alertas WHERE id_alerta = ?";
            $result = $this->select($sql, [$id]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Error en selectAlerta: " . $e->getMessage());
            return null;
        }
    }

    public function insertAlerta(string $tipo_alerta, string $fecha, string $hora, int $id_sensor): array
    {
        try {
            $fechaHora = $fecha . ' ' . $hora;
            $sql = "INSERT INTO alertas (tipo_alerta, fecha, hora, id_sensor) VALUES (?, ?, ?, ?)";
            $insertId = $this->insert($sql, [$tipo_alerta, $fecha, $hora, $id_sensor]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertAlerta: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al insertar la alerta'];
        }
    }

    public function updateAlerta(int $id, string $tipo_alerta, string $fecha, string $hora, int $id_sensor): array
    {
        try {
            $fechaHora = $fecha . ' ' . $hora;
            $sql = "UPDATE alertas SET tipo_alerta = ?, fecha = ?, hora = ?, id_sensor = ? WHERE id_alerta = ?";
            $result = $this->update($sql, [$tipo_alerta, $fecha, $hora, $id_sensor, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Alerta actualizada' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateAlerta: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar la alerta'];
        }
    }

    public function deleteAlerta(int $id): array
    {
        try {
            $sql = "DELETE FROM alertas WHERE id_alerta = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Alerta eliminada' : 'Alerta no encontrada'];
        } catch (Exception $e) {
            error_log("Error en deleteAlerta: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar la alerta'];
        }
    }
}