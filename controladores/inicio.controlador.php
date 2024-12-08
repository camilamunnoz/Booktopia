<?php

require_once "modelos/categoria.php";

class Iniciocontrolador
{
    private $modelo;

    public function __CONSTRUCT(){
        $this->modelo = new Categoria();
    }

    public function Inicio(){
        require_once "vistas/header.php";
        require_once "vistas/inicio/principal.php";
        require_once "vistas/footer.php";
    }
}