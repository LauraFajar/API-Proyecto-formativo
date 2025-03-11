<!DOCTYPE html>
<html>
<head>
    <title>Lista de Almacenes</title>
</head>
<body>
    <h1>Lista de Almacenes</h1>
    <a href="<?php echo BASE_URL; ?>views/almacenes/crear.php">Crear Nuevo Almacén</a>
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
            <?php foreach ($lista_almacenes as $almacen): ?>
                <tr>
                    <td><?php echo $almacen['id_almacen']; ?></td>
                    <td><?php echo $almacen['nombre']; ?></td>
                    <td><?php echo $almacen['descripcion']; ?></td>
                    <td>
                        <a href="<?php echo BASE_URL; ?>views/almacenes/editar.php?id=<?php echo $almacen['id_almacen']; ?>">Editar</a>
                        <a href="<?php echo BASE_URL; ?>controllers/AlmacenesController.php?accion=eliminar&id=<?php echo $almacen['id_almacen']; ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>