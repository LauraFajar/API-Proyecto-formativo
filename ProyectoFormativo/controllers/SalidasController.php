<?php
require_once '../config/Database.php';
require_once '../models/Salidas.php';
require_once '../models/Insumos.php';

$database = new Database();
$db = $database->getConnection();
$salidas = new Salidas($db);
$insumosModel = new Insumos($db);

// Crear Salida
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_salida'])) {
    $monto = $_POST['monto'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];
    $id_insumo = $_POST['id_insumo'];

    if ($salidas->crearSalida($monto, $fecha, $descripcion, $id_insumo)) {
        header("Location: ../views/salidas/listar.php");
    } else {
        echo "Error al crear la salida.";
    }
}

// Actualizar Salida
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_salida'])) {
    $id = $_POST['id'];
    $monto = $_POST['monto'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];
    $id_insumo = $_POST['id_insumo'];

    if ($salidas->actualizarSalida($id, $monto, $fecha, $descripcion, $id_insumo)) {
        header("Location: ../views/salidas/listar.php");
    } else {
        echo "Error al actualizar la salida.";
    }
}

// Eliminar Salida
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($salidas->eliminarSalida($id)) {
        header("Location: ../views/salidas/listar.php");
    } else {
        echo "Error al eliminar la salida.";
    }
}

// Obtener lista de salidas (para listar.php)
$lista_salidas = $salidas->obtenerSalidas();

// Obtener salida por ID (para editar.php)
if (isset($_GET['accion']) && $_GET['accion'] === 'editar' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $salida = $salidas->obtenerSalidaPorId($id);
    $insumos = $insumosModel->obtenerInsumos(); // Obtener insumos para el formulario de edición
}

// Obtener insumos (para crear.php)
$insumos = $insumosModel->obtenerInsumos();
?>