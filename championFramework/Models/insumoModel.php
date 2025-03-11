<?php
class InsumoModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectInsumos() {
        $sql = "SELECT * FROM insumos";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectInsumo($id) {
        $sql = "SELECT * FROM insumos WHERE id = ?";
        $request = $this->select($sql, array($id));
        return $request;
    }

    public function insertInsumo($nombre_insumo, $codigo, $fecha_entrada, $observacion, $id_categoria, $id_almacen, $id_salida) {
        $sql = "INSERT INTO insumos (nombre_insumo, codigo, fecha_entrada, observacion, id_categoria, id_almacen, id_salida) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $arrData = array($nombre_insumo, $codigo, $fecha_entrada, $observacion, $id_categoria, $id_almacen, $id_salida);
        $request = $this->insert($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }

    public function updateInsumo($id, $nombre_insumo, $codigo, $fecha_entrada, $observacion, $id_categoria, $id_almacen, $id_salida) {
        $sql = "UPDATE insumos SET nombre_insumo = ?, codigo = ?, fecha_entrada = ?, observacion = ?, id_categoria = ?, id_almacen = ?, id_salida = ? WHERE id = ?";
        $arrData = array($nombre_insumo, $codigo, $fecha_entrada, $observacion, $id_categoria, $id_almacen, $id_salida, $id);
        $request = $this->update($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }

    public function deleteInsumo($id) {
        $sql = "DELETE FROM insumos WHERE id = ?";
        $arrData = array($id);
        $request = $this->delete($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }
}