<?php
spl_autoload_register(function ($class) {
    // Definir rutas base donde buscar las clases
    $paths = [
        "Libraries/Core/",
        "Models/",
        "Controllers/"
    ];

    foreach ($paths as $path) {
        $file = $path . $class . ".php";
        if (file_exists($file)) {
            require_once($file);
            return;
        }
    }

    // Si no se encuentra la clase, registrar un error
    error_log("Error: Clase '$class' no encontrada en las rutas definidas.");
});
?>