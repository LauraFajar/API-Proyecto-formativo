<?php

class InsumoModels {
    private $conn;
    private $table_name = "insumos";

    public $id_insumo;
    public $nombre_insumo;
    public $codigo;
    public $fecha_entrada;
    public $observacion;
    public $id_categoria;
    public $id_almacen;
    public $id_salida;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerTodos() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET nombre_insumo=:nombre_insumo, codigo=:codigo, fecha_entrada=:fecha_entrada, 
                      observacion=:observacion, id_categoria=:id_categoria, id_almacen=:id_almacen, id_salida=:id_salida";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre_insumo", $this->nombre_insumo);
        $stmt->bindParam(":codigo", $this->codigo);
        $stmt->bindParam(":fecha_entrada", $this->fecha_entrada);
        $stmt->bindParam(":observacion", $this->observacion);
        $stmt->bindParam(":id_categoria", $this->id_categoria);
        $stmt->bindParam(":id_almacen", $this->id_almacen);
        $stmt->bindParam(":id_salida", $this->id_salida);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}