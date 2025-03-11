<?php
class UsuarioModel  extends Mysql{
    private $intIdUsuario;
    private $strIdentificacion;
    private $strNombres;
    private $strEmail;
    private $strPassword;
    private $strTipoDocumento;
    private $intNumeroDocumento;

    public function __construct()
    {
        parent::__construct();
    }

    public function setCliente(string $identificacion, string $nombres, string $email, string $password, string $tipo_documento, int $numero_documento)
    {
        $this->strIdentificacion = $identificacion;
        $this->strNombres = $nombres;
        $this->strEmail = $email;
        $this->strPassword = $password;
        $this->strTipoDocumento = $tipo_documento;
        $this->intNumeroDocumento = $numero_documento;

        $sql = "SELECT identificacion,email FROM usuario WHERE (email =:email or identificacion =:ident) and status =:estado";
        $arrayParams = array(
            ":email"=>$this->strEmail,
            ":ident"=>$this->strIdentificacion,
            ":estado"=>1
        );

        $request = $this->select($sql, $arrayParams);

        if(!empty($request)){
            return false;
        } else {
            $query_insert = "INSERT INTO usuario(identificacion,nombres,email,password,tipo_documento,numero_documento) VALUES (:ident, :nom, :email, :pass, :tipo_doc, :num_doc)";

            $arrayData = array(
                ":ident"=>$this->strIdentificacion,
                ":nom"=>$this->strNombres,
                ":email"=>$this->strEmail,
                ":pass"=>$this->strPassword,
                ":tipo_doc"=>$this->strTipoDocumento,
                ":num_doc"=>$this->intNumeroDocumento
            );

            $request_insert = $this->insert($query_insert, $arrayData);
            return $request_insert;
        }
    }
}