<?php
class Usuario  extends Controllers{

    public function __construct()
    {
        parent::__construct();
    }

    public function usuario($idUsuario)
    {
        echo "Hola desde usuarios con el id: ".$idUsuario;
    }

    public function registro(){
        $response = [];
        
        try{
            $method = ($_SERVER['REQUEST_METHOD']);
            if ($method == "POST"){

                $_POST=json_decode(file_get_contents(filename: 'php://input'), associative: true);

                if(empty($_POST['identificacion']))
                {
                    $response = array('status' => false , 'msg' => 'La identificación es requerida');
                    jsonResponse($response, code: 200);
                    die();
                }

                if(!testString($_POST['nombres']))
                {
                    $response = array('status' => false , 'msg' => 'Error en los nombres');
                    jsonResponse($response, code: 200);
                    die();
                }

                if(!testEmail($_POST['email']))
                {
                    $response = array('status' => false , 'msg' => 'Error en el email');
                    jsonResponse($response, code: 200);
                    die();
                }

                if(empty($_POST['password']) || strlen($_POST['password']) < 6)
                {
                    $response = array('status' => false , 'msg' => 'La contraseña es requerida y debe tener al menos 6 caracteres');
                    jsonResponse($response, code: 200);
                    die();
                }

                if(empty($_POST['tipo_documento']))
                {
                    $response = array('status' => false , 'msg' => 'El tipo de documento es requerido');
                    jsonResponse($response, code: 200);
                    die();
                }

                if(empty($_POST['numero_documento']) || !is_numeric($_POST['numero_documento']))
                {
                    $response = array('status' => false , 'msg' => 'El número de documento es requerido y debe ser numérico');
                    jsonResponse($response, code: 200);
                    die();
                }

                $strIdentificacion = $_POST['identificacion'];
                $strNombres = ucwords(strtolower($_POST['nombres']));
                $strEmail = strtolower($_POST['email']);
                $strPassword = hash('sha256', $_POST['password']);
                $strTipoDocumento = $_POST['tipo_documento'];
                $intNumeroDocumento = $_POST['numero_documento'];

                $request = $this->model->setCliente($strIdentificacion,
                $strNombres,
                $strEmail,
                $strPassword,
                $strTipoDocumento,
                $intNumeroDocumento);

                if($request>0){
                    $arrayCliente =array(
                        'identificacion' => $strIdentificacion,
                        'nombres' => $strNombres,
                        'email' => $strEmail,
                        'password' => $strPassword,
                        'tipo_documento' => $strTipoDocumento,
                        'numero_documento' => $intNumeroDocumento
                    );
                    $response = array(
                        'status' => true,
                        'msg' => 'Datos guardados con exito ',
                        'data'=>$arrayCliente
                    );
                }else{
                    $response = array(
                        'status'=> false,
                        'msg'=>'La identificacion o email existen en su DB'
                    );
                }
                $code=200;

            }  
            else{
                $response = array(
                    'status' => false,
                    'msg' => 'Error en la solicitud por el metodo: '.$method.'.Cambie a POST'
                );
                $code = 400;   
            }

        }catch (Exception $e){
            echo "Error en el proceso: ".$e->getMessage();

        }
    }
}
