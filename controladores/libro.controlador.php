<?php

require_once "modelos/libro.php";

class LibroControlador{

    private $modelo;

    public function __CONSTRUCT(){
        
        $this->modelo = new Libro();
    }

    public function Inicio(){
        
        require_once "vistas/header.php";
        require_once "vistas/libros/index.php";
        require_once "vistas/footer.php";
    }

    public function Form()
    {
        $libro = new Libro();
        $tituloFormulario = "Crear";

        if(isset($_GET['id']))
        {
           $libro = $this->modelo->ObtenerPorId($_GET['id']);
           $tituloFormulario = "Editar";
        }

        require_once "vistas/header.php";
        require_once "vistas/libros/form.php";
        require_once "vistas/footer.php";
    }


    public function Guardar()
    {
        $libro = new Libro();

        $libro->setIdLibro(intval($_POST['id_libro']));
        $libro->setTitulo($_POST['titulo']);
        $libro->setNombreAutor($_POST['nombre_autor']);
        $libro->setFormato($_POST['formato']);
        $libro->setPrecio($_POST['precio']);
        $libro->setSinopsis($_POST['sinopsis']);

        if($libro->getIdLibro() == 0)
        {
            $this->modelo->Insertar($libro);
        }
        else
        {
            $this->modelo->Actualizar($libro);
        }


        header("location:?c=libro");

    }

    public function Eliminar()
    {
        $this->modelo->Eliminar($_GET['id']);

        header("location:?c=libro");
    }
}