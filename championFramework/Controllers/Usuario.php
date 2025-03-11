<?php
class Usuario extends Controllers {

    public function __construct() {
        parent::__construct();
    }

    public function usuario($idUsuario) {
        echo "Hola desde usuarios con el id: " . $idUsuario;
    }

    public function registro() {
        $response = [];

        try {
            $method = ($_SERVER['REQUEST_METHOD']);
            if ($method == "POST") {

                $_POST = json_decode(file_get_contents('php://input'), true);

                if (empty($_POST['numero_documento']) || !is_numeric($_POST['numero_documento'])) {
                    $response = array('status' => false, 'msg' => 'El número de documento es requerido y debe ser numérico');
                    jsonResponse($response, 200);
                    die();
                }

                if (!testString($_POST['nombres'])) {
                    $response = array('status' => false, 'msg' => 'Error en los nombres');
                    jsonResponse($response, 200);
                    die();
                }

                if (!testEmail($_POST['email'])) {
                    $response = array('status' => false, 'msg' => 'Error en el email');
                    jsonResponse($response, 200);
                    die();
                }

                if (empty($_POST['password']) || strlen($_POST['password']) < 6) {
                    $response = array('status' => false, 'msg' => 'La contraseña es requerida y debe tener al menos 6 caracteres');
                    jsonResponse($response, 200);
                    die();
                }

                if (empty($_POST['tipo_documento'])) {
                    $response = array('status' => false, 'msg' => 'El tipo de documento es requerido');
                    jsonResponse($response, 200);
                    die();
                }

                $strNombres = ucwords(strtolower($_POST['nombres']));
                $strEmail = strtolower($_POST['email']);
                $strPassword = hash('sha256', $_POST['password']);
                $strTipoDocumento = $_POST['tipo_documento'];
                $intNumeroDocumento = $_POST['numero_documento'];

                $request = $this->model->setCliente(
                    $intNumeroDocumento,
                    $strNombres,
                    $strEmail,
                    $strPassword,
                    $strTipoDocumento
                );

                if ($request > 0) {
                    $arrayCliente = array(
                        'numero_documento' => $intNumeroDocumento,
                        'nombres' => $strNombres,
                        'email' => $strEmail,
                        'password' => $strPassword,
                        'tipo_documento' => $strTipoDocumento
                    );
                    $response = array(
                        'status' => true,
                        'msg' => 'Datos guardados con éxito',
                        'data' => $arrayCliente
                    );
                } else {
                    $response = array(
                        'status' => false,
                        'msg' => 'El número de documento o email ya existen en la base de datos'
                    );
                }
                $code = 200;

            } else {
                $response = array(
                    'status' => false,
                    'msg' => 'Error en la solicitud por el método: ' . $method . '. Cambie a POST'
                );
                $code = 400;
            }

        } catch (Exception $e) {
            echo "Error en el proceso: " . $e->getMessage();
        }

        jsonResponse($response, $code);
    }
}