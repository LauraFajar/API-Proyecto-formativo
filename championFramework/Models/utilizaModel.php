<?php
class UtilizaModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectUtilizas() {
        $sql = "SELECT * FROM utiliza";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectUtiliza($id) {
        $sql = "SELECT * FROM utiliza WHERE id = ?";
        $request = $this->select($sql, array($id));
        return $request;
    }

    public function insertUtiliza($id_actividades, $id_insumos) {
        $sql = "INSERT INTO utiliza (id_actividades, id_insumos) VALUES (?, ?)";
        $arrData = array($id_actividades, $id_insumos);
        $request = $this->insert($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }

    public function updateUtiliza($id, $id_actividades, $id_insumos) {
        $sql = "UPDATE utiliza SET id_actividades = ?, id_insumos = ? WHERE id = ?";
        $arrData = array($id_actividades, $id_insumos, $id);
        $request = $this->update($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }

    public function deleteUtiliza($id) {
        $sql = "DELETE FROM utiliza WHERE id = ?";
        $arrData = array($id);
        $request = $this->delete($sql, $arrData);
        return array('status' => true, 'id' => $request);
    }
}