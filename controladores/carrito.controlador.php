<?php

require_once "modelos/carrito.php";

class CarritoControlador{

    private $modelo;

    public function __construct(){

        $this->modelo = new Carrito();
    }

    public function Inicio(){
        
        require_once "vistas/header.php";
        require_once "vistas/carrito/index.php";
        require_once "vistas/footer.php";
    }

    public function Form()
    {
        $carrito = new Carrito();
        $tituloFormulario = "Crear";

        if(isset($_GET['id']))
        {
           $carrito = $this->modelo->ObtenerPorId($_GET['id']);
           $tituloFormulario = "Editar";
        }

        require_once "vistas/header.php";
        require_once "vistas/carrito/form.php";
        require_once "vistas/footer.php";
    }


    public function Guardar()
    {
        $carrito = new Carrito();

        $carrito->setIdCarrito(intval($_POST['id_carrito']));
        $carrito->setIdUsuario($_SESSION['id_usuario']);
        $carrito->setFechaCreacion(date("Y-m-d H:i:s"));
        $carrito->setTotal(0);

        if($carrito->getIdCarrito() == 0)
        {
            $this->modelo->Insertar($carrito);
        }
        else
        {
            $this->modelo->Actualizar($carrito);
        }


        header("location:?c=carrito");

    }

    public function Eliminar()
    {
        $this->modelo->Eliminar($_GET['id']);

        header("location:?c=carrito");
    }
}