<?php

class ClienteModel extends Mysql
{
    private $strIdentificacion;
    private $strNombre;
    private $strApellido;
    private $strTelefono;
    private $strEmail;
    private $strDireccion;
    private $strNit;
    private $strNombreFiscal;
    private $strDireccionFiscal;
    public function __construct()
    {
        parent::__construct();
    }

    public function setCliente(string $strIdentificacion, string$strNombre,string $strApellido,int $strTelefono, string $strEmail,string $strDireccion,string $strNit,string $strNombreFiscal,string $strDireccionFiscal){

        $this->strIdentificacion = $strIdentificacion;
        $this->strNombre = $strNombre;
        $this->strApellido = $strApellido;
        $this->strTelefono = $strTelefono;
        $this->strEmail = $strEmail;
        $this->strDireccion = $strDireccion;
        $this->strNit = $strNit;
        $this->strNombreFiscal = $strNombreFiscal;
        $this->strDireccionFiscal = $strDireccionFiscal;

        //VALIDAR SI EL USUARIO EXISTE EN LA BD
        $sql = " SELECT identificacion, email FROM cliente WHERE (email = :email or identificacion = :iden) and status = :estado;";

        $arraParams = [
            ":email" => $this->strEmail,
            ":iden" => $this->strIdentificacion,
            ":estado" => 1,
        ];

        $request = $this -> select($sql, $arraParams);

        if(!empty($request)){
            return false;
        }else{
            //INSERTAR UN USUARIO NUEVO POR QUE NO EXISTE EN LA BD

            $query_insert = "INSERT INTO cliente(identificacion, nombres, apellidos, telefono, email, direccion, nit, nombreFiscal, direccionFiscal) VALUES (:ident, :nom, :ape, :tel, :email, :dir, :nit, :nombreF, :direccionF)";

            $arrayData = [
                ":ident" => $this->strIdentificacion,
                ":nom" => $this->strNombre,
                ":ape" => $this->strApellido,
                ":tel" => $this->strTelefono,
                ":email" => $this->strEmail,
                ":dir" => $this->strDireccion,
                ":nit" => $this->strNit,
                ":nombreF" => $this->strNombreFiscal,
                ":direccionF" => $this->strDireccionFiscal,
            ];

            $request_insert = $this->insert($query_insert, $arrayData );
            return $request_insert;
        }

    }

}

?>