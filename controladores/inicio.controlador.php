<?php

require_once "modelos/categoria.php";
require_once "modelos/libro.php";

class Iniciocontrolador
{
    private $modelo;
    private $libro;

    public function __CONSTRUCT(){
        $this->modelo = new Categoria();
        $this->libro = new Libro();
    }

    public function Inicio(){

        session_start();

        if(isset($_SESSION['id_usuario'])){
            $this->Principal();
        }

        require_once "vistas/header-login.php";
        require_once "vistas/login/login.php";
        require_once "vistas/footer-login.php";
    }

    public function Principal(){
        require_once "vistas/header.php";
        require_once "vistas/inicio/principal.php";
        require_once "vistas/footer.php";
    }
}