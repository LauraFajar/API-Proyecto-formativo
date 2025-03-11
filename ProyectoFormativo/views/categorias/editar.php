<!DOCTYPE html>
<html>
<head>
    <title>Editar Categoría</title>
</head>
<body>
    <h1>Editar Categoría</h1>
    <form method="POST" action="<?php echo BASE_URL; ?>controllers/CategoriasController.php">
        <input type="hidden" name="id" value="<?php echo $categoria['id_categoria']; ?>">

        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $categoria['nombre']; ?>"><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion"><?php echo $categoria['descripcion']; ?></textarea><br><br>

        <button type="submit" name="actualizar_categoria">Actualizar Categoría</button>
    </form>
</body>
</html>