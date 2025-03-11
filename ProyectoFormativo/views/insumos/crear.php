<!DOCTYPE html>
<html>
<head>
    <title>Crear Nuevo Insumo</title>
</head>
<body>
    <h1>Crear Nuevo Insumo</h1>
    <form method="POST" action="<?php echo BASE_URL; ?>controllers/InsumosController.php">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre"><br><br>

        <label for="codigo">Código:</label><br>
        <input type="text" id="codigo" name="codigo"><br><br>

        <label for="fecha_entrada">Fecha de Entrada:</label><br>
        <input type="date" id="fecha_entrada" name="fecha_entrada"><br><br>

        <label for="observacion">Observación:</label><br>
        <textarea id="observacion" name="observacion"></textarea><br><br>

        <label for="id_categoria">Categoría:</label><br>
        <select id="id_categoria" name="id_categoria">
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?php echo $categoria['id_categoria']; ?>">
                    <?php echo $categoria['nombre']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="id_almacen">Almacén:</label><br>
        <select id="id_almacen" name="id_almacen">
            <?php foreach ($almacenes as $almacen): ?>
                <option value="<?php echo $almacen['id_almacen']; ?>">
                    <?php echo $almacen['nombre']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="id_salida">Salida:</label><br>
        <select id="id_salida" name="id_salida">
            <?php foreach ($salidas as $salida): ?>
                <option value="<?php echo $salida['id_salida']; ?>">
                    <?php echo $salida['descripcion']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit" name="crear_insumo">Crear Insumo</button>
    </form>
</body>
</html>