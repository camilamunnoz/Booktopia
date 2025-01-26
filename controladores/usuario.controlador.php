<?php

require_once "modelos/usuario.php";

class UsuarioControlador{

    private $modelo;

    public function __construct(){

        $this->modelo = new Usuario();
    }

    public function Inicio(){
        
        session_destroy();

        require_once "vistas/header-login.php";
        require_once "vistas/login/login.php";
        require_once "vistas/footer-login.php";
    }



    public function Login()
    {
        $correo = $_POST['correo'];
        $clave = $_POST['clave'];

        $usuario = $this->modelo->Login($correo, $clave);

        session_start();

        if($usuario->getExitoso())
        {
            $_SESSION['id_usuario'] = $usuario->getIdUsuario();
            $_SESSION['nombre_completo_usuario'] = $usuario->getNombreCompleto();
            $_SESSION['correo_usuario'] = $usuario->getCorreo();
            $_SESSION['rol_usuario'] = $usuario->getIdRol();

            header("location:?c=inicio&a=Principal");
        }
        else
        {
            header("location:?c=inicio");
        }
    }

    
    public function Logout(){
        
        session_start();
        header("location:?c=inicio&a=Inicio");
        session_destroy();
    }

    public function Guardar()
    {
        $usuario = new Usuario();

        $usuario->setIdUsuario(intval(value: $_POST['id_usuario']));
        $usuario->setNombreCompleto($_POST['nombre_completo']);
        $usuario->setCorreo($_POST['correo']);
        $usuario->setClave($_POST['clave']);
        $usuario->setIdRol($_POST['id_rol']);

        if($usuario->getIdUsuario() == 0)
        {
            $this->modelo->Insertar($usuario);
        }
        else
        {
            $this->modelo->Actualizar($usuario);
        }


        header("location:?c=usuario");

    }

    public function Eliminar()
    {
        $this->modelo->Eliminar($_GET['id']);

        header("location:?c=usuario");
    }
}