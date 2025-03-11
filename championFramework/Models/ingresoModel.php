<?php
class IngresoModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectIngresos() {
        $sql = "SELECT * FROM ingresos";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectIngreso($id) {
        $sql = "SELECT * FROM ingresos WHERE id = ?";
        $request = $this->select($sql, array($id));
        return $request;
    }

    public function insertIngreso($fecha_ingreso, $monto, $descripcion, $id_insumo) {
        $sql = "INSERT INTO ingresos (fecha_ingreso, monto, descripcion, id_insumo) VALUES (?, ?, ?, ?)";
        $arrData = array($fecha_ingreso, $monto, $descripcion, $id_insumo);
        $request = $this->insert($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }

    public function updateIngreso($id, $fecha_ingreso, $monto, $descripcion, $id_insumo) {
        $sql = "UPDATE ingresos SET fecha_ingreso = ?, monto = ?, descripcion = ?, id_insumo = ? WHERE id = ?";
        $arrData = array($fecha_ingreso, $monto, $descripcion, $id_insumo, $id);
        $request = $this->update($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }

    public function deleteIngreso($id) {
        $sql = "DELETE FROM ingresos WHERE id = ?";
        $arrData = array($id);
        $request = $this->delete($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }
}