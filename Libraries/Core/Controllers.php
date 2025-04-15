<?php

class Controllers {
    public $views;
    public $model;

    public function __construct() {
        $this->views = new Views();
        $this->loadModel();
    }

    public function loadModel() {
        $modelName = get_class($this) . "Model"; 
        $baseDir = "Models/"; 
        $modelPath = null;

        // Buscar en todas las subcarpetas de Models
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($baseDir));
        foreach ($iterator as $file) {
            if ($file->getFilename() === $modelName . ".php") {
                $modelPath = $file->getPathname();
                break;
            }
        }

        if ($modelPath && file_exists($modelPath)) {
            require_once($modelPath);

            if (class_exists($modelName)) {
                $this->model = new $modelName();
                error_log("Modelo cargado correctamente: " . $modelName);
            } else {
                error_log("Error: La clase '$modelName' no existe en el archivo '$modelPath'.");
                $this->model = null;
            }
        } else {
            error_log("Error: Modelo no encontrado: " . $modelName);
            $this->model = null;
        }
    }
}