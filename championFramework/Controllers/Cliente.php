<?php
class Cliente  extends Controllers{

    public function __construct()
    {
        parent::__construct();
    }

    public function cliente($idCliente)
    {
        echo "Hola desde clientes con el id: ".$idCliente;
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

                if(!testString($_POST['apellidos']))
                {
                    $response = array('status' => false , 'msg' => 'Error en los apellidos');
                    jsonResponse($response, code: 200);
                    die();
                }

                if(!testEntero($_POST['telefono']))
                {
                    $response = array('status' => false , 'msg' => 'Error en el teléfono');
                    jsonResponse($response, code: 200);
                    die();
                }

                if(!testEmail($_POST['email']))
                {
                    $response = array('status' => false , 'msg' => 'Error en el email');
                    jsonResponse($response, code: 200);
                    die();
                }

                $strIdentificacion = $_POST['identificacion'];
                $strNombres = ucwords(strtolower($_POST['nombres']));
                $strApellidos = ucwords(strtolower($_POST['apellidos']));
                $intTelefono = $_POST['telefono'];
                $strEmail = strtolower($_POST['email']);

                $request = $this->model->setCliente($strIdentificacion,
                $strNombres,
                $strApellidos,
                $intTelefono,
                $strEmail);

                if($request>0){
                    $arrayCliente =array(
                        'identificacion' => $strIdentificacion,
                        'nombres' => $strNombres,
                        'apellidos' => $strApellidos,
                        'telefono' => $intTelefono,
                        'email' => $strEmail
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
            echo "Error en el proceso: ".$e->getMessage[];

        }
    }
    }


