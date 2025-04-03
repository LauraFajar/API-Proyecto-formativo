<?php

class Validator {
    // usuarios
    public static function validateUsuario($data) {
    $errors = [];
    if (empty($data['nombres']) || !self::testString($data['nombres'])) {
        $errors[] = "Los nombres son obligatorios y deben ser válidos.";
    }
    if (empty($data['email']) || !self::testEmail($data['email'])) {
        $errors[] = "El email es obligatorio y debe ser válido.";
    }
    if (empty($data['password']) || strlen($data['password']) < 6) {
        $errors[] = "La contraseña es obligatoria y debe tener al menos 6 caracteres.";
    }
    if (empty($data['tipo_documento'])) {
        $errors[] = "El tipo de documento es obligatorio.";
    }
    if (empty($data['numero_documento']) || !is_numeric($data['numero_documento'])) {
        $errors[] = "El número de documento es obligatorio y debe ser numérico.";
    }
    if (empty($data['id_rol']) || !is_numeric($data['id_rol'])) {
        $errors[] = "El ID del rol es obligatorio y debe ser numérico.";
    }
    return $errors;
}
    public static function testString($string) {
    return preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $string);
}
    public static function testEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

    public static function validateRol($data) {
    $errors = [];
    if (empty($data['nombre_rol'])) {
        $errors[] = "El nombre del rol es obligatorio.";
    }
    if (empty($data['id_tipo_rol']) || !is_numeric($data['id_tipo_rol'])) {
        $errors[] = "El ID del tipo de rol es obligatorio y debe ser numérico.";
    }
    return $errors;
}

    public static function validateTipoRol($data) {
    $errors = [];
    if (empty($data['descripcion'])) {
        $errors[] = "La descripción es obligatoria.";
    }
    return $errors;
}

    public static function validateRealiza($data){
        $errors = [];

        if (!isset($data['usuario'])) {
            $errors['usuario'] = 'El campo usuario es requerido.';
        } elseif (!is_numeric($data['usuario']) || $data['usuario'] <= 0) {
            $errors['usuario'] = 'El campo usuario debe ser un número entero positivo.';
        }

        if (!isset($data['actividad'])) {
            $errors['actividad'] = 'El campo actividad es requerido.';
        } elseif (!is_numeric($data['actividad']) || $data['actividad'] <= 0) {
            $errors['actividad'] = 'El campo actividad debe ser un número entero positivo.';
        }

        return $errors;
    }
    //finanzas
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
        if (empty($data['nombre'])) {
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
        //fitosanitario
    public static function validateEpa($data) {
        $errors = [];
        if (empty($data['nombre_epa'])) {
            $errors[] = "El nombre de la EPA es obligatorio.";
        }
        if (empty($data['descripcion'])) {
            $errors[] = "La descripción es obligatoria.";
        }
        return $errors;
    }

    public static function validateTiene($data) {
        $errors = [];
        if (empty($data['cultivo']) || !is_numeric($data['cultivo'])) {
            $errors[] = "El ID del cultivo es obligatorio y debe ser numérico.";
        }
        if (empty($data['epa']) || !is_numeric($data['epa'])) {
            $errors[] = "El ID de la EPA es obligatorio y debe ser numérico.";
        }
        return $errors;
    }

    public static function validateTratamiento($data) {
        $errors = [];
        if (empty($data['descripcion'])) {
            $errors[] = "La descripción es obligatoria.";
        }
        if (empty($data['dosis']) || !is_numeric($data['dosis'])) {
            $errors[] = "La dosis es obligatoria y debe ser numérica.";
        }
        if (empty($data['frecuencia'])) {
            $errors[] = "La frecuencia es obligatoria.";
        }
        if (empty($data['id_epa']) || !is_numeric($data['id_epa'])) {
            $errors[] = "El ID de la EPA es obligatorio y debe ser numérico.";
        }
        return $errors;
    }
        //cultivos
    public static function validateCultivo($data) {
        $errors = [];
        if (empty($data['tipo_cultivo'])) {
            $errors[] = "El tipo de cultivo es obligatorio.";
        }
        if (empty($data['id_lote']) || !is_numeric($data['id_lote'])) {
            $errors[] = "El ID del lote es obligatorio y debe ser numérico.";
        }
        if (empty($data['id_insumo']) || !is_numeric($data['id_insumo'])) {
            $errors[] = "El ID del insumo es obligatorio y debe ser numérico.";
        }
        return $errors;
    }

    public static function validateLote($data) {
        $errors = [];
        if (empty($data['nombre_lote'])) {
            $errors[] = "El nombre del lote es obligatorio.";
        }
        if (empty($data['descripcion'])) {
            $errors[] = "La descripción del lote es obligatoria.";
        }
        return $errors;
    }

    public static function validateSublote($data) {
        $errors = [];
        if (empty($data['descripcion'])) {
            $errors[] = "La descripción del sublote es obligatoria.";
        }
        if (empty($data['id_lote']) || !is_numeric($data['id_lote'])) {
            $errors[] = "El ID del lote es obligatorio y debe ser numérico.";
        }
        if (empty($data['ubicacion'])) {
            $errors[] = "La ubicación del sublote es obligatoria.";
        }
        return $errors;
    }

    public static function validateActividad($data) {
        $errors = [];
        if (empty($data['tipo_actividad'])) {
            $errors[] = "El tipo de actividad es obligatorio.";
        }
        if (empty($data['fecha']) || !preg_match('/^\d{4}\/\d{2}\/\d{2}$/', $data['fecha'])) {
            $errors[] = "La fecha es obligatoria y debe tener el formato año/mes/día (YYYY/MM/DD).";
        }
        if (empty($data['responsable'])) {
            $errors[] = "El responsable es obligatorio.";
        }
        if (empty($data['detalles'])) {
            $errors[] = "Los detalles son obligatorios.";
        }
        if (empty($data['id_cultivo']) || !is_numeric($data['id_cultivo'])) {
            $errors[] = "El ID del cultivo es obligatorio y debe ser numérico.";
        }
        return $errors;
    }
        //iot
    public static function validateSensor($data) {
        $errors = [];
        if (empty($data['tipo_sensor'])) {
            $errors[] = "El tipo de sensor es obligatorio.";
        }
        if (empty($data['id_sublote']) || !is_numeric($data['id_sublote'])) {
            $errors[] = "El ID del sublote es obligatorio y debe ser numérico.";
        }
        if (empty($data['estado'])) {
            $errors[] = "El estado es obligatorio.";
        }
        return $errors;
    }

    public static function validateAlerta($data) {
        $errors = [];
        if (empty($data['tipo_alerta'])) {
            $errors[] = "El tipo de alerta es obligatorio.";
        }
        if (empty($data['fecha']) || !preg_match('/^\d{4}\/\d{2}\/\d{2}$/', $data['fecha'])) {
            $errors[] = "La fecha es obligatoria y debe tener el formato año/mes/día (YYYY/MM/DD).";
        }
        if (empty($data['hora']) || !preg_match('/^\d{2}:\d{2}:\d{2}$/', $data['hora'])) {
            $errors[] = "La hora es obligatoria y debe tener el formato HH:MM:SS (24 horas).";
        }
        if (empty($data['id_sensor']) || !is_numeric($data['id_sensor'])) {
            $errors[] = "El ID del sensor es obligatorio y debe ser numérico.";
        }
        return $errors;
    }
        //inventario
    public static function validateInventario($data) {
        $errors = [];
        if (empty($data['id_insumo']) || !is_numeric($data['id_insumo'])) {
            $errors[] = "El ID del insumo es obligatorio y debe ser numérico.";
        }
        if (empty($data['cantidad_stock']) || !is_numeric($data['cantidad_stock'])) {
            $errors[] = "La cantidad en stock es obligatoria y debe ser numérica.";
        }
        if (empty($data['unidad_medida'])) {
            $errors[] = "La unidad de medida es obligatoria.";
        }
        if (empty($data['fecha']) || !preg_match('/^\d{4}\/\d{2}\/\d{2}$/', $data['fecha'])) {
            $errors[] = "La fecha es obligatoria y debe tener el formato año/mes/día (YYYY/MM/DD).";
        }
        return $errors;
    }

    public static function validateMovimiento($data) {
        $errors = [];
        if (empty($data['tipo_movimiento']) || !in_array($data['tipo_movimiento'], ['Entrada', 'Salida'])) {
            $errors[] = "El tipo de movimiento es obligatorio y debe ser 'Entrada' o 'Salida'.";
        }
        if (empty($data['id_insumo']) || !is_numeric($data['id_insumo'])) {
            $errors[] = "El ID del insumo es obligatorio y debe ser numérico.";
        }
        if (empty($data['cantidad']) || !is_numeric($data['cantidad'])) {
            $errors[] = "La cantidad es obligatoria y debe ser numérica.";
        }
        if (empty($data['unidad_medida'])) {
            $errors[] = "La unidad de medida es obligatoria.";
        }
        if (empty($data['fecha_movimiento']) || !preg_match('/^\d{4}\/\d{2}\/\d{2}$/', $data['fecha_movimiento'])) {
            $errors[] = "La fecha es obligatoria y debe tener el formato año/mes/día (YYYY/MM/DD).";
        }
        return $errors;
    }
}
