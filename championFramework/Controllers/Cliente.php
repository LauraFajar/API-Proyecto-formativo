<?php
class Cliente extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cliente($idcliente){
        echo "Hola desde cliente con id: ".$idcliente;
    }
    public function clientes(){
        echo "Hola desde clientes: ";
    }
    public function registro()
    {
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            $response = [];

            if($method == "POST")
            {
                $_POST = json_decode(file_get_contents('php://input'),true);

                if(empty($_POST['identificacion']))
                {
                    $response = array('status' => false , 'msg' => 'La identificación es requerida');
                    jsonResponse($response,200);
                    die();
                }

                if(!testString($_POST['nombres']))
                {
                    $response = array('status' => false , 'msg' => 'Error en los nombres');
                    jsonResponse($response,200);
                    die();
                }

                if(!testString($_POST['apellidos']))
                {
                    $response = array('status' => false , 'msg' => 'Error en los apellidos');
                    jsonResponse($response,200);
                    die();
                }

                if(!testEntero($_POST['telefono']))
                {
                    $response = array('status' => false , 'msg' => 'Error en el teléfono');
                    jsonResponse($response,200);
                    die();
                }

                if(!testEmail($_POST['email']))
                {
                    $response = array('status' => false , 'msg' => 'Error en el email');
                    jsonResponse($response,200);
                    die();
                }

                if(empty($_POST['direccion']))
                {
                    $response = array('status' => false , 'msg' => 'La direccion es requerida');
                    jsonResponse($response,200);
                    die();
                }

                $strIdentificacion = $_POST['identificacion'];
                $strNombres = ucwords(strtolower($_POST['nombres']));
                $strApellidos = ucwords(strtolower($_POST['apellidos']));
                $intTelefono = $_POST['telefono'];
                $strEmail = strtolower($_POST['email']);
                $strDireccion = $_POST['direccion'];
                $strNit = !empty($_POST['nit']) ? strClean($_POST['nit']) : "";
                $strNomFiscal = !empty($_POST['nombrefiscal']) ? strClean($_POST['nombrefiscal']) : "";
                $strDirFiscal = !empty($_POST['direccionfiscal']) ? strClean($_POST['direccionfiscal']) : "";

                $request = $this->model->setCliente($strIdentificacion,
                    $strNombres,
                    $strApellidos,
                    $intTelefono,
                    $strEmail,
                    $strDireccion,
                    $strNit,
                    $strNomFiscal,
                    $strDirFiscal);

                if($request > 0)
                {
                    $arrCliente = array('idcliente' => $request,
                        'identificacion' => $strIdentificacion,
                        'nombres' => $strNombres,
                        'apellidos' => $strApellidos,
                        'telefono' => $intTelefono,
                        'email' => $strEmail,
                        'direccion' => $strDireccion,
                        'nit' => $strNit,
                        'nombreFiscal' => $strNomFiscal,
                        'direccionFiscal' => $strDirFiscal
                    );
                    $response = array('status' => true , 'msg' => 'Datos guardados correctamente', 'data' => $arrCliente);
                }else{
                    $response = array('status' => false , 'msg' => 'La identificación o el email ya existe');
                }

                $code = 200;
            }else{
                $response = array('status' => false , 'msg' => 'Error en la solicitud '.$method);
                $code = 400;
            }

            jsonResponse($response,$code);
            die();

        } catch (Exception $e) {
            echo "Error en el proceso: ". $e->getMessage();
        }
        die();
    }

    public function actualizar($idcliente){
        echo "Actualizar cliente con id: ".$idcliente;
    }
    public function eliminar($idcliente){
    echo "Eliminar cliente con id: ".$idcliente;
}


}


