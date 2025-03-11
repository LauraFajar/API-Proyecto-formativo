<?php
class Insumos {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerInsumos() {
        $query = "SELECT * FROM insumos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerInsumoPorId($id) {
        $query = "SELECT * FROM insumos WHERE id_insumo = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registrarInsumo($nombre, $codigo, $fecha_entrada, $observacion, $id_categoria, $id_almacen, $id_salida) {
        $query = "INSERT INTO insumos (nombre_insumo, codigo, fecha_entrada, observacion, id_categoria, id_almacen, id_salida) VALUES (:nombre, :codigo, :fecha_entrada, :observacion, :id_categoria, :id_almacen, :id_salida)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":codigo", $codigo);
        $stmt->bindParam(":fecha_entrada", $fecha_entrada);
        $stmt->bindParam(":observacion", $observacion);
        $stmt->bindParam(":id_categoria", $id_categoria);
        $stmt->bindParam(":id_almacen", $id_almacen);
        $stmt->bindParam(":id_salida", $id_salida);
        return $stmt->execute();
    }

    public function actualizarInsumo($id, $nombre, $codigo, $fecha_entrada, $observacion, $id_categoria, $id_almacen, $id_salida) {
        $query = "UPDATE insumos SET nombre_insumo = :nombre, codigo = :codigo, fecha_entrada = :fecha_entrada, observacion = :observacion, id_categoria = :id_categoria, id_almacen = :id_almacen, id_salida = :id_salida WHERE id_insumo = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":codigo", $codigo);
        $stmt->bindParam(":fecha_entrada", $fecha_entrada);
        $stmt->bindParam(":observacion", $observacion);
        $stmt->bindParam(":id_categoria", $id_categoria);
        $stmt->bindParam(":id_almacen", $id_almacen);
        $stmt->bindParam(":id_salida", $id_salida);
        return $stmt->execute();
    }

    public function eliminarInsumo($id) {
        $query = "DELETE FROM insumos WHERE id_insumo = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>