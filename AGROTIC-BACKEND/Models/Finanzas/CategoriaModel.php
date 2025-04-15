<?php
class CategoriaModel extends Mysql {

    public function __construct() {
        parent::__construct();
    }

    public function selectCategorias() {
        try {
            $sql = "SELECT * FROM categorias";
            return $this->select_all($sql);
        } catch (Exception $e) {
            error_log("Error en selectCategorias: " . $e->getMessage());
            return false;
        }
    }

    public function selectCategoria($id) {
        try {
            $sql = "SELECT * FROM categorias WHERE id_categoria = ?";
            return $this->select($sql, [$id]);
        } catch (Exception $e) {
            error_log("Error en selectCategoria: " . $e->getMessage());
            return false;
        }
    }

    public function insertCategoria($nombre, $descripcion) {
        try {
            $sql = "INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)";
            $insertId = $this->insert($sql, [$nombre, $descripcion]);
            return ['status' => true, 'id' => $insertId];
        } catch (Exception $e) {
            error_log("Error en insertCategoria: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al insertar la categoría'];
        }
    }

    public function updateCategoria($id, $nombre, $descripcion) {
        try {
            $sql = "UPDATE categorias SET nombre = ?, descripcion = ? WHERE id_categoria = ?";
            $result = $this->update($sql, [$nombre, $descripcion, $id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Categoría actualizada' : 'No se realizaron cambios'];
        } catch (Exception $e) {
            error_log("Error en updateCategoria: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al actualizar la categoría'];
        }
    }

    public function deleteCategoria(int $id): array {
        try {
            $sql = "DELETE FROM categorias WHERE id_categoria = ?";
            $result = $this->delete($sql, [$id]);
            return ['status' => $result > 0, 'msg' => $result > 0 ? 'Categoría eliminada' : 'No se encontró la categoría'];
        } catch (Exception $e) {
            error_log("Error en deleteCategoria: " . $e->getMessage());
            return ['status' => false, 'msg' => 'Error al eliminar la categoría'];
        }
    }
}