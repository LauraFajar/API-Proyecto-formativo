<!DOCTYPE html>
<html>
<head>
    <title>Editar Ingreso</title>
</head>
<body>
    <h1>Editar Ingreso</h1>
    <form method="POST" action="<?php echo BASE_URL; ?>controllers/IngresosController.php">
        <input type="hidden" name="id" value="<?php echo $ingreso['id_ingreso']; ?>">

        <label for="monto">Monto:</label><br>
        <input type="number" id="monto" name="monto" value="<?php echo $ingreso['monto']; ?>"><br><br>

        <label for="fecha">Fecha:</label><br>
        <input type="date" id="fecha" name="fecha" value="<?php echo $ingreso['fecha_ingreso']; ?>"><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion"><?php echo $ingreso['descripcion']; ?></textarea><br><br>

        <label for="id_insumo">Insumo:</label><br>
        <select id="id_insumo" name="id_insumo">
            <?php foreach ($insumos as $insumo_opcion): ?>
                <option value="<?php echo $insumo_opcion['id_insumo']; ?>" <?php if ($ingreso['id_insumo'] == $insumo_opcion['id_insumo']) echo 'selected'; ?>>
                    <?php echo $insumo_opcion['nombre_insumo']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit" name="actualizar_ingreso">Actualizar Ingreso</button>
    </form>
</body>
</html>