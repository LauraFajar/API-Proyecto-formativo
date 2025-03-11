<?php
require_once '../config/Database.php';
require_once '../models/Insumos.php';
require_once '../models/Categorias.php';
require_once '../models/Almacenes.php';
require_once '../models/Salidas.php';

$database = new Database();
$db = $database->getConnection();
$insumos = new Insumos($db);
$categoriasModel = new Categorias($db);
$almacenesModel = new Almacenes($db);
$salidasModel = new Salidas($db);

// Crear Insumo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_insumo'])) {
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $fecha_entrada = $_POST['fecha_entrada'];
    $observacion = $_POST['observacion'];
    $id_categoria = $_POST['id_categoria'];
    $id_almacen = $_POST['id_almacen'];
    $id_salida = $_POST['id_salida'];

    if ($insumos->crearInsumo($nombre, $codigo, $fecha_entrada, $observacion, $id_categoria, $id_almacen, $id_salida)) {
        header("Location: ../views/insumos/listar.php");
    } else {
        echo "Error al crear el insumo.";
    }
}

// Actualizar Insumo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_insumo'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $fecha_entrada = $_POST['fecha_entrada'];
    $observacion = $_POST['observacion'];
    $id_categoria = $_POST['id_categoria'];
    $id_almacen = $_POST['id_almacen'];
    $id_salida = $_POST['id_salida'];

    if ($insumos->actualizarInsumo($id, $nombre, $codigo, $fecha_entrada, $observacion, $id_categoria, $id_almacen, $id_salida)) {
        header("Location: ../views/insumos/listar.php");
    } else {
        echo "Error al actualizar el insumo.";
    }
}

// Eliminar Insumo
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($insumos->eliminarInsumo($id)) {
        header("Location: ../views/insumos/listar.php");
    } else {
        echo "Error al eliminar el insumo.";
    }
}

// Obtener lista de insumos (para listar.php)
$lista_insumos = $insumos->obtenerInsumos();

// Obtener insumo por ID (para editar.php)
if (isset($_GET['accion']) && $_GET['accion'] === 'editar' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $insumo = $insumos->obtenerInsumoPorId($id);
    $categorias = $categoriasModel->obtenerCategorias();
    $almacenes = $almacenesModel->obtenerAlmacenes();
    $salidas = $salidasModel->obtenerSalidas();
}

// Obtener categorías, almacenes y salidas (para crear.php)
$categorias = $categoriasModel->obtenerCategorias();
$almacenes = $almacenesModel->obtenerAlmacenes();
$salidas = $salidasModel->obtenerSalidas();
?>