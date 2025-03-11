<?php
class CategoriaModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectCategorias() {
        $sql = "SELECT * FROM categorias";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectCategoria($id) {
        $sql = "SELECT * FROM categorias WHERE id = ?";
        $request = $this->select($sql, array($id));
        return $request;
    }

    public function insertCategoria($nombre, $descripcion) {
        $sql = "INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)";
        $arrData = array($nombre, $descripcion);
        $request = $this->insert($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }

    public function updateCategoria($id, $nombre, $descripcion) {
        $sql = "UPDATE categorias SET nombre = ?, descripcion = ? WHERE id = ?";
        $arrData = array($nombre, $descripcion, $id);
        $request = $this->update($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }

    public function deleteCategoria($id) {
        $sql = "DELETE FROM categorias WHERE id = ?";
        $arrData = array($id);
        $request = $this->delete($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }
}