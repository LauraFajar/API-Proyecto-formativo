<?php
class Ingresos {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrarIngreso($fecha_ingreso, $monto, $descripcion, $id_insumo) {
        $query = "INSERT INTO ingresos (fecha_ingreso, monto, descripcion, id_insumo) VALUES (:fecha, :monto, :descripcion, :insumo)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->bindParam(":monto", $monto);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":insumo", $id_insumo);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function obtenerIngresos() {
        $query = "SELECT * FROM ingresos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerIngresoPorId($id) {
        $query = "SELECT * FROM ingresos WHERE id_ingreso = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarIngreso($id, $fecha, $monto, $descripcion, $id_insumo) {
        $query = "UPDATE ingresos SET fecha_ingreso = :fecha, monto = :monto, descripcion = :descripcion, id_insumo = :insumo WHERE id_ingreso = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->bindParam(":monto", $monto);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":insumo", $id_insumo);
        return $stmt->execute();
    }

    public function eliminarIngreso($id) {
        $query = "DELETE FROM ingresos WHERE id_ingreso = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Obtener insumos para el formulario de ingresos
    public function obtenerInsumos() {
        $query = "SELECT id_insumo, nombre_insumo FROM insumos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Calcular costos totales (ejemplo)
    public function calcularCostosTotales() {
        $query = "SELECT SUM(monto) as total_costos FROM ingresos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_costos'];
    }

    // Otras funciones para cálculos de costos y generación de gráficos
}
?>