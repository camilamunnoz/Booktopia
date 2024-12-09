<?php

require_once "modelos/genero.php";

class GeneroControlador{

    private $modelo;

    public function __CONSTRUCT(){
        
        $this->modelo = new Genero();
    }

    public function Inicio(){
        
        require_once "vistas/header.php";
        require_once "vistas/generos/index.php";
        require_once "vistas/footer.php";
    }

    public function Form()
    {
        $genero = new Genero();
        $tituloFormulario = "Crear";

        if(isset($_GET['id']))
        {
           $genero = $this->modelo->ObtenerPorId($_GET['id']);
           $tituloFormulario = "Editar";
        }

        require_once "vistas/header.php";
        require_once "vistas/generos/form.php";
        require_once "vistas/footer.php";
    }


    public function Guardar()
    {
        $genero = new Genero();

        $genero->setIdGenero(intval($_POST['id_genero']));
        $genero->setNombreGenero($_POST['nombre_genero']);
        $genero->setDescripcion($_POST['descripcion']);

        if($genero->getIdGenero() == 0)
        {
            $this->modelo->Insertar($genero);
        }
        else
        {
            $this->modelo->Actualizar($genero);
        }


        header("location:?c=genero");

    }

    public function Eliminar()
    {
        $this->modelo->Eliminar($_GET['id']);

        header("location:?c=genero");
    }
}