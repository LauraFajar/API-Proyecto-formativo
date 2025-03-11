<!DOCTYPE html>
<html>
<head>
    <title>Lista de Insumos</title>
</head>
<body>
    <h1>Lista de Insumos</h1>
    <a href="<?php echo BASE_URL; ?>views/insumos/crear.php">Crear Nuevo Insumo</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Código</th>
                <th>Fecha Entrada</th>
                <th>Observación</th>
                <th>Categoría</th>
                <th>Almacén</th>
                <th>Salida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista_insumos as $insumo): ?>
                <tr>
                    <td><?php echo $insumo['id_insumo']; ?></td>
                    <td><?php echo $insumo['nombre_insumo']; ?></td>
                    <td><?php echo $insumo['codigo']; ?></td>
                    <td><?php echo $insumo['fecha_entrada']; ?></td>
                    <td><?php echo $insumo['observacion']; ?></td>
                    <td><?php echo $insumo['id_categoria']; ?></td>
                    <td><?php echo $insumo['id_almacen']; ?></td>
                    <td><?php echo $insumo['id_salida']; ?></td>
                    <td>
                        <a href="<?php echo BASE_URL; ?>views/insumos/editar.php?id=<?php echo $insumo['id_insumo']; ?>">Editar</a>
                        <a href="<?php echo BASE_URL; ?>controllers/InsumosController.php?accion=eliminar&id=<?php echo $insumo['id_insumo']; ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>