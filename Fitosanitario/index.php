<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("Config/Config.php");
require_once("Helpers/Helpers.php");

try {
    $url = !empty($_GET['url']) ? $_GET['url'] : "home/home";
    $arrUrl = explode("/", $url);
    $controller = ucwords($arrUrl[0]);
    $method = $arrUrl[1] ?? "index";
    $params = array_slice($arrUrl, 2);

    $controllerFile = "Controllers/" . $controller . ".php";
    if (file_exists($controllerFile)) {
        require_once($controllerFile);
        $controllerInstance = new $controller();
        if (method_exists($controllerInstance, $method)) {
            call_user_func_array([$controllerInstance, $method], $params);
        } else {
            throw new Exception("Método no encontrado: $method");
        }
    } else {
        throw new Exception("Controlador no encontrado: $controller");
    }
} catch (Exception $e) {
    http_response_code(404);
    echo json_encode(["error" => $e->getMessage()]);
}