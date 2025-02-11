<?php

require_once "modelos/carrito.php";
require_once "modelos/libros_carrito.php";
require_once "modelos/libro.php";

class CarritoControlador{

    private $modelo;
    private $librosCarrito;
    private $libro;
    private $totalCarrito = 0.0;

    public function __construct(){

        $this->modelo = new Carrito();
        $this->librosCarrito = new LibrosCarrito();
        $this->libro = new Libro();
    }

    public function Inicio(){
        
        require_once "vistas/header.php";
        require_once "vistas/carrito/index.php";
        require_once "vistas/footer.php";
    }

    public function AgregarAlCarrito(){

        session_start();

        if(isset($_GET['id']))
        {
           $libro = $this->libro->ObtenerPorIdNull($_GET['id']);

           if($libro === null)
           {
                die("No se pudo encontrar el libro");
           }

           $id_usuario = $_SESSION['id_usuario'];

           $carrito = $this->modelo->ObtenerPorIdUsuario($id_usuario);
           $libroCarrito = $this->librosCarrito->ObtenerPorIdLibro($_GET['id'], $carrito->getIdCarrito());

           if($libroCarrito === null)
           {
                $libroCarrito = new LibrosCarrito();

                $libroCarrito->setIdCarrito($carrito->getIdCarrito());
                $libroCarrito->setIdLibro($_GET['id']);
                $libroCarrito->setCantidadLibro(1);
    
                $this->librosCarrito->Insertar($libroCarrito);
           }          

           header("location:?c=carrito");
        }
    }

    public function EliminarDelCarrito(){
        
        if(isset($_GET['id']))
        {
           $libroCarrito = $this->librosCarrito->ObtenerPorId($_GET['id']);

           if($libroCarrito === null)
           {
                die("No se pudo encontrar el libro dentro del carrito");
           }

           $this->librosCarrito->Eliminar($libroCarrito->getIdLibrosCarrito());

           header("location:?c=carrito");
        }
    }

    public function ConsultarLibrosCarrito(){

        
        $id_usuario = $_SESSION['id_usuario'];

        $carrito = $this->modelo->ObtenerPorIdUsuario($id_usuario);

        $resultado = $this->librosCarrito->ListarPorCarrito($carrito->getIdCarrito());

        foreach ($resultado as $r)
        {
            $this->totalCarrito = $this->totalCarrito + (doubleval($r->precio) * doubleval($r->cantidad_libro));
        }

        return $resultado;
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