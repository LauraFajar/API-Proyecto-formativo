<?php
class ClienteModel  extends Mysql{
    private $intIdCliente;
    private $strIdentificacion;
    private $strNombres;
    private $strApellidos;
    private $intTelefono;
    private $strEmail;


    public function __construct()
    {
        parent::__construct();
    }

    public function setCliente(string $identificacion, string $nombres, string $apellidos, int $telefono, string $email){
       $this->strIdentificacion = $identificacion;
       $this->strNombres = $nombres;
       $this->strApellidos = $apellidos;
       $this->intTelefono = $telefono;
       $this->strEmail = $email;

       $sql = "SELECT identificacion,email FROM cliente WHERE (email =:email or identificacion =:ident) and status =:estado";
       $arrayParams = array(
        ":email"=>$this->strEmail,
        ".ident"=>$this->strIdentificacion,
        ":estado"=>1
       );
    }

    $request = $this->select($sql,$arrayParams);

    if(!empty($request)){
        return false;
    }else{
        $query_insert="INSERT INTO cliente(identificacion,nombres,apellidos,telefono,email) VALUES (:ident, :nom, :ape, :tel, :email)";

        $arrayData = array(
            ":ident"=>$this->strIdentificacion,
            ":nom"=>$this->strNombres,
            ":ape"=>$this->strApellidos,
            ":tel"=>$this->intTelefono,
            ":email"=>$this->strEmail
        );

        $request_insert=$this->insert($query_insert,$arrayData);
        return $request_insert;

    }
    }