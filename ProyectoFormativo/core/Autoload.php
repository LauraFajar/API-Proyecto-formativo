<?php
spl_autoload_register(function ($nombre_clase) {
    $ruta_clase = str_replace('\\', DIRECTORY_SEPARATOR, $nombre_clase) . '.php';
    if (file_exists($ruta_clase)) {
        require_once $ruta_clase;
    }
});
?>