<!DOCTYPE html>
<html>
<head>
    <title>Lista de Categorías</title>
</head>
<body>
    <h1>Lista de Categorías</h1>
    <a href="<?php echo BASE_URL; ?>views/categorias/crear.php">Crear Nueva Categoría</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista_categorias as $categoria): ?>
                <tr>
                    <td><?php echo $categoria['id_categoria']; ?></td>
                    <td><?php echo $categoria['nombre']; ?></td>
                    <td><?php echo $categoria['descripcion']; ?></td>
                    <td>
                        <a href="<?php echo BASE_URL; ?>views/categorias/editar.php?id=<?php echo $categoria['id_categoria']; ?>">Editar</a>
                        <a href="<?php echo BASE_URL; ?>controllers/CategoriasController.php?accion=eliminar&id=<?php echo $categoria['id_categoria']; ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>