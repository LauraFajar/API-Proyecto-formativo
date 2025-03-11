<?php
class SalidaModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectSalidas() {
        $sql = "SELECT * FROM salidas";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectSalida($id) {
        $sql = "SELECT * FROM salidas WHERE id = ?";
        $request = $this->select($sql, array($id));
        return $request;
    }

    public function insertSalida($nombre, $codigo, $cantidad, $observacion, $fecha_salida, $id_categoria, $id_almacen) {
        $sql = "INSERT INTO salidas (nombre, codigo, cantidad, observacion, fecha_salida, id_categoria, id_almacen) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $arrData = array($nombre, $codigo, $cantidad, $observacion, $fecha_salida, $id_categoria, $id_almacen);
        $request = $this->insert($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }

    public function updateSalida($id, $nombre, $codigo, $cantidad, $observacion, $fecha_salida, $id_categoria, $id_almacen) {
        $sql = "UPDATE salidas SET nombre = ?, codigo = ?, cantidad = ?, observacion = ?, fecha_salida = ?, id_categoria = ?, id_almacen = ? WHERE id = ?";
        $arrData = array($nombre, $codigo, $cantidad, $observacion, $fecha_salida, $id_categoria, $id_almacen, $id);
        $request = $this->update($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }

    public function deleteSalida($id) {
        $sql = "DELETE FROM salidas WHERE id = ?";
        $arrData = array($id);
        $request = $this->delete($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }
}