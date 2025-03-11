<?php
class UsuarioModel extends Mysql {
    private $intIdUsuario;
    private $strNombres;
    private $strEmail;
    private $strPassword;
    private $strTipoDocumento;
    private $intNumeroDocumento;

    public function __construct() {
        parent::__construct();
    }

    public function setCliente(string $nombres, string $email, string $password, string $tipo_documento, int $numero_documento) {
        $this->strNombres = $nombres;
        $this->strEmail = $email;
        $this->strPassword = $password;
        $this->strTipoDocumento = $tipo_documento;
        $this->intNumeroDocumento = $numero_documento;

        $sql = "SELECT numero_documento, email FROM usuario WHERE (email = :email OR numero_documento = :num_doc) AND status = :estado";
        $arrayParams = array(
            ":email" => $this->strEmail,
            ":num_doc" => $this->intNumeroDocumento,
            ":estado" => 1
        );

        $request = $this->select($sql, $arrayParams);

        if (!empty($request)) {
            return false;
        } else {
            $query_insert = "INSERT INTO usuario(nombres, email, password, tipo_documento, numero_documento) VALUES (:nom, :email, :pass, :tipo_doc, :num_doc)";
            $arrayData = array(
                ":nom" => $this->strNombres,
                ":email" => $this->strEmail,
                ":pass" => $this->strPassword,
                ":tipo_doc" => $this->strTipoDocumento,
                ":num_doc" => $this->intNumeroDocumento
            );

            $request_insert = $this->insert($query_insert, $arrayData);
            return $request_insert;
        }
    }
}