<!DOCTYPE html>
<html>
<head>
    <title>Editar Almacén</title>
</head>
<body>
    <h1>Editar Almacén</h1>
    <form method="POST" action="<?php echo BASE_URL; ?>controllers/AlmacenesController.php">
        <input type="hidden" name="id" value="<?php echo $almacen['id_almacen']; ?>">

        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $almacen['nombre']; ?>"><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion"><?php echo $almacen['descripcion']; ?></textarea><br><br>

        <button type="submit" name="actualizar_almacen">Actualizar Almacén</button>
    </form>
</body>
</html>