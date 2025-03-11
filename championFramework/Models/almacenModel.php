<?php
class AlmacenModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectAlmacenes() {
        $sql = "SELECT * FROM almacenes";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectAlmacen($id) {
        $sql = "SELECT * FROM almacenes WHERE id = ?";
        $request = $this->select($sql, array($id));
        return $request;
    }

    public function insertAlmacen($nombre, $descripcion) {
        $sql = "INSERT INTO almacenes (nombre_almacen, descripcion) VALUES (?, ?)";
        $arrData = array($nombre, $descripcion);
        $request = $this->insert($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }

    public function updateAlmacen($id, $nombre, $descripcion) {
        $sql = "UPDATE almacenes SET nombre_almacen = ?, descripcion = ? WHERE id = ?";
        $arrData = array($nombre, $descripcion, $id);
        $request = $this->update($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }

    public function deleteAlmacen($id) {
        $sql = "DELETE FROM almacenes WHERE id = ?";
        $arrData = array($id);
        $request = $this->delete($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }
}