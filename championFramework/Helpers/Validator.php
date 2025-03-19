<?php

class Validator {
    public static function validateAlmacen($data) {
        $errors = [];

        if (empty($data['nombre_almacen'])) {
            $errors[] = "El nombre del almacén es obligatorio.";
        }
        if (empty($data['descripcion'])) {
            $errors[] = "La descripción es obligatoria.";
        }

        return $errors;
    }

    public static function validateCategoria($data) {
        $errors = [];
        if (empty($data['nombre_categoria'])) {
            $errors[] = "El nombre de la categoría es obligatorio.";
        }
        if (empty($data['descripcion'])) {
            $errors[] = "La descripción es obligatoria.";
        }

        return $errors;
    }

    public static function validateIngreso($data) {
        $errors = [];
        if (empty($data['fecha_ingreso'])) {
            $errors[] = "La fecha de ingreso es obligatoria.";
        }
        if (empty($data['monto'])) {
            $errors[] = "El monto es obligatorio.";
        }
        if (empty($data['descripcion'])) {
            $errors[] = "La descripción es obligatoria.";
        }
        if (empty($data['id_insumo'])) {
            $errors[] = "El id del insumo es obligatorio.";
        }

        return $errors;
    }

    public static function validateInsumo($data) {
        $errors = [];
        if (empty($data['nombre_insumo'])) {
            $errors[] = "El nombre del insumo es obligatorio.";
        }
        if (empty($data['codigo'])) {
            $errors[] = "El código del insumo es obligatorio.";
        }
        if (empty($data['fecha_entrada'])) {
            $errors[] = "La fecha de entrada es obligatoria.";
        }
        if (empty($data['observacion'])) {
            $errors[] = "La observación es obligatoria.";
        }
        if (empty($data['id_categoria'])) {
            $errors[] = "El ID de la categoría es obligatorio.";
        }
        if (empty($data['id_almacen'])) {
            $errors[] = "El ID del almacén es obligatorio.";
        }
        if (empty($data['id_salida'])) {
            $errors[] = "El ID de la salida es obligatorio.";
        }
        return $errors;
    }

    public static function validateSalida($data) {
        $errors = [];
        if (empty($data['nombre'])) {
            $errors[] = "El nombre es obligatorio.";
        }
        if (empty($data['codigo'])) {
            $errors[] = "El código es obligatorio.";
        }
        if (empty($data['cantidad'])) {
            $errors[] = "La cantidad es obligatoria.";
        }
        if (empty($data['id_categorias'])) {
            $errors[] = "El ID de la categoría es obligatorio.";
        }
        if (empty($data['id_almacenes'])) {
            $errors[] = "El ID del almacén es obligatorio.";
        }
        if (empty($data['observacion'])) {
            $errors[] = "La observación es obligatoria.";
        }
        if (empty($data['fecha_salida'])) {
            $errors[] = "La fecha de salida es obligatoria.";
        }
        return $errors;
    }

    public static function validateUtiliza($data) {
        $errors = [];
        if (empty($data['id_actividades'])) {
            $errors[] = "El ID de actividades es obligatorio.";
        }
        if (empty($data['id_insumos'])) {
            $errors[] = "El ID de insumos es obligatorio.";
        }
        return $errors;
    }
}