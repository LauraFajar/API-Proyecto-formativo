<?php
require_once '../config/Database.php';
require_once '../models/Ingresos.php';

$database = new Database();
$db = $database->getConnection();
$ingresos = new Ingresos($db);

// Crear Ingreso
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_ingreso'])) {
    $fecha = $_POST['fecha_ingreso'];
    $monto = $_POST['monto'];
    $descripcion = $_POST['descripcion'];
    $id_insumo = $_POST['id_insumo'];

    if ($ingresos->crearIngreso($fecha, $monto, $descripcion, $id_insumo)) {
        header("Location: ../views/ingresos/listar.php");
    } else {
        echo "Error al crear el ingreso.";
    }
}

// Actualizar Ingreso
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_ingreso'])) {
    $id = $_POST['id'];
    $fecha = $_POST['fecha_ingreso'];
    $monto = $_POST['monto'];
    $descripcion = $_POST['descripcion'];
    $id_insumo = $_POST['id_insumo'];

    if ($ingresos->actualizarIngreso($id, $fecha, $monto, $descripcion, $id_insumo)) {
        header("Location: ../views/ingresos/listar.php");
    } else {
        echo "Error al actualizar el ingreso.";
    }
}

// Eliminar Ingreso
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($ingresos->eliminarIngreso($id)) {
        header("Location: ../views/ingresos/listar.php");
    } else {
        echo "Error al eliminar el ingreso.";
    }
}

// Obtener lista de ingresos (para listar.php)
$lista_ingresos = $ingresos->obtenerIngresos();

// Obtener ingreso por ID (para editar.php)
if (isset($_GET['accion']) && $_GET['accion'] === 'editar' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $ingreso = $ingresos->obtenerIngresoPorId($id);
    $insumos = $ingresos->obtenerInsumos(); // Obtener insumos para el formulario de edición
}

// Obtener insumos (para crear.php)
$insumos = $ingresos->obtenerInsumos();
?>