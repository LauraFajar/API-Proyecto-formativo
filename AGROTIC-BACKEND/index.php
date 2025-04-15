<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("Config/Config.php");
require_once("Helpers/Helpers.php");
require_once("Libraries/Core/Controllers.php");
require_once("Libraries/Core/Autoload.php");

$url = !empty($_GET['url']) ? $_GET['url'] : "home/home/index";
$arrUrl = explode("/", $url);

// Extraer modulo, controlador, metodo y parametros
$module = isset($arrUrl[0]) ? ucfirst($arrUrl[0]) : "Home"; 
$controller = isset($arrUrl[1]) ? ucfirst($arrUrl[1]) : "Home"; 
$method = isset($arrUrl[2]) ? $arrUrl[2] : "index"; 
$params = array_slice($arrUrl, 3); 

$controllerPath = "Controllers/" . $module . "/" . $controller . ".php";

if (file_exists($controllerPath)) {
    require_once($controllerPath);

    if (class_exists($controller)) {
        $controllerClass = new $controller();

        if (method_exists($controllerClass, $method)) {
            call_user_func_array([$controllerClass, $method], $params);
        } else {
            die("Error: Método '$method' no encontrado en el controlador '$controller'.");
        }
    } else {
        die("Error: Clase del controlador '$controller' no encontrada.");
    }
} else {
    die("Error: Controlador '$controller' no encontrado en el módulo '$module'.");
}