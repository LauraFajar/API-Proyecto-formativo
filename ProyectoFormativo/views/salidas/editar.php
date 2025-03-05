<!DOCTYPE html>
<html>
<head>
    <title>Editar Salida</title>
</head>
<body>
    <h1>Editar Salida</h1>
    <form method="POST" action="<?php echo BASE_URL; ?>controllers/SalidasController.php">
        <input type="hidden" name="id" value="<?php echo $salida['id_salida']; ?>">

        <label for="monto">Monto:</label><br>
        <input type="number" id="monto" name="monto" value="<?php echo $salida['monto']; ?>"><br><br>

        <label for="fecha">Fecha:</label><br>
        <input type="date" id="fecha" name="fecha" value="<?php echo $salida['fecha_salida']; ?>"><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion"><?php echo $salida['descripcion']; ?></textarea><br><br>

        <label for="id_insumo">Insumo:</label><br>
        <select id="id_insumo" name="id_insumo">
            <?php foreach ($insumos as $insumo): ?>
                <option value="<?php echo $insumo['id_insumo']; ?>" <?php if ($salida['id_insumo'] == $insumo['id_insumo']) echo 'selected'; ?>>
                    <?php echo $insumo['nombre_insumo']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit" name="actualizar_salida">Actualizar Salida</button>
    </form>
</body>
</html>