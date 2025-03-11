<?php
require_once '../config/Database.php';
require_once '../models/Categorias.php';

$database = new Database();
$db = $database->getConnection();
$categorias = new Categorias($db);

// Crear Categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_categoria'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    if ($categorias->crearCategoria($nombre, $descripcion)) {
        header("Location: ../views/categorias/listar.php");
    } else {
        echo "Error al crear la categoría.";
    }
}

// Actualizar Categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_categoria'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    if ($categorias->actualizarCategoria($id, $nombre, $descripcion)) {
        header("Location: ../views/categorias/listar.php");
    } else {
        echo "Error al actualizar la categoría.";
    }
}

// Eliminar Categoría
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($categorias->eliminarCategoria($id)) {
        header("Location: ../views/categorias/listar.php");
    } else {
        echo "Error al eliminar la categoría.";
    }
}

// Obtener lista de categorías (para listar.php)
$lista_categorias = $categorias->obtenerCategorias();

// Obtener categoría por ID (para editar.php)
if (isset($_GET['accion']) && $_GET['accion'] === 'editar' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $categoria = $categorias->obtenerCategoriaPorId($id);
}
?>