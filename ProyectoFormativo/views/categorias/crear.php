<!DOCTYPE html>
<html>
<head>
    <title>Crear Nueva Categoría</title>
</head>
<body>
    <h1>Crear Nueva Categoría</h1>
    <form method="POST" action="<?php echo BASE_URL; ?>controllers/CategoriasController.php">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre"><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion"></textarea><br><br>

        <button type="submit" name="crear_categoria">Crear Categoría</button>
    </form>
</body>
</html>