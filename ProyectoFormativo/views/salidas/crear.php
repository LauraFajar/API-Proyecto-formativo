<!DOCTYPE html>
<html>
<head>
    <title>Crear Nueva Salida</title>
</head>
<body>
    <h1>Crear Nueva Salida</h1>
    <form method="POST" action="<?php echo BASE_URL; ?>controllers/SalidasController.php">
        <label for="monto">Monto:</label><br>
        <input type="number" id="monto" name="monto"><br><br>

        <label for="fecha">Fecha:</label><br>
        <input type="date" id="fecha" name="fecha"><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion"></textarea><br><br>

        <label for="id_insumo">Insumo:</label><br>
        <select id="id_insumo" name="id_insumo">
            <?php foreach ($insumos as $insumo): ?>
                <option value="<?php echo $insumo['id_insumo']; ?>">
                    <?php echo $insumo['nombre_insumo']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit" name="crear_salida">Crear Salida</button>
    </form>
</body>
</html>