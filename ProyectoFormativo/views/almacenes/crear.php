<!DOCTYPE html>
<html>
<head>
    <title>Crear Nuevo Almacén</title>
</head>
<body>
    <h1>Crear Nuevo Almacén</h1>
    <form method="POST" action="<?php echo BASE_URL; ?>controllers/AlmacenesController.php">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre"><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion"></textarea><br><br>

        <button type="submit" name="crear_almacen">Crear Almacén</button>
    </form>
</body>
</html>