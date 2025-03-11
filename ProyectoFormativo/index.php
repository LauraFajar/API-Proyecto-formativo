<?php
require_once 'config/Config.php';
require_once 'core/Autoload.php';

$database = new Database();
$db = $database->getConnection();
$ingresos = new Ingresos($db);
$lista_ingresos = $ingresos->obtenerIngresos();

include 'views/dashboard.php';
?>