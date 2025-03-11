<!DOCTYPE html>
<html>
<head>
    <title>Lista de Salidas</title>
</head>
<body>
    <h1>Lista de Salidas</h1>
    <a href="<?php echo BASE_URL; ?>views/salidas/crear.php">Crear Nueva Salida</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Insumo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista_salidas as $salida): ?>
                <tr>
                    <td><?php echo $salida['id_salida']; ?></td>
                    <td><?php echo $salida['monto']; ?></td>
                    <td><?php echo $salida['fecha_salida']; ?></td>
                    <td><?php echo $salida['descripcion']; ?></td>
                    <td><?php echo $salida['id_insumo']; ?></td>
                    <td>
                        <a href="<?php echo BASE_URL; ?>views/salidas/editar.php?id=<?php echo $salida['id_salida']; ?>">Editar</a>
                        <a href="<?php echo BASE_URL; ?>controllers/SalidasController.php?accion=eliminar&id=<?php echo $salida['id_salida']; ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>