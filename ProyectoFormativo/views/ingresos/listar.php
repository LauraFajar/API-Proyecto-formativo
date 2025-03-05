<!DOCTYPE html>
<html>
<head>
    <title>Lista de Ingresos</title>
</head>
<body>
    <h1>Lista de Ingresos</h1>
    <a href="<?php echo BASE_URL; ?>views/ingresos/crear.php">Crear Nuevo Ingreso</a>
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
            <?php foreach ($lista_ingresos as $ingreso): ?>
                <tr>
                    <td><?php echo $ingreso['id_ingreso']; ?></td>
                    <td><?php echo $ingreso['monto']; ?></td>
                    <td><?php echo $ingreso['fecha_ingreso']; ?></td>
                    <td><?php echo $ingreso['descripcion']; ?></td>
                    <td><?php echo $ingreso['id_insumo']; ?></td>
                    <td>
                        <a href="<?php echo BASE_URL; ?>views/ingresos/editar.php?id=<?php echo $ingreso['id_ingreso']; ?>">Editar</a>
                        <a href="<?php echo BASE_URL; ?>controllers/IngresosController.php?accion=eliminar&id=<?php echo $ingreso['id_ingreso']; ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>