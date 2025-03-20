<?php

require_once '../Models/NotificacionesModels.php';
require_once '../config/Database.php';

// Crear conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Crear instancia del modelo
$notificacion = new NotificacionesModels($db);

// Obtener datos del cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"));

// Validar que los datos requeridos estén presentes
if (!empty($data->mensaje) && !empty($data->tipo) && !empty($data->destinatario)) {
    // Asignar valores al modelo
    $notificacion->mensaje = $data->mensaje;
    $notificacion->tipo = $data->tipo;
    $notificacion->destinatario = $data->destinatario;

    // Intentar enviar la notificación
    try {
        if ($notificacion->enviar()) {
            echo json_encode(["message" => "Notificación enviada con éxito."]);
        } else {
            echo json_encode(["message" => "No se pudo enviar la notificación."]);
        }
    } catch (Exception $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Datos incompletos."]);
}