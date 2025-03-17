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
        echo "Hola desde registro";
    }
    }
