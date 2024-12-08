<?php

require_once "modelos/categoria.php";

class CategoriaControlador{

    private $modelo;

    public function __construct(){

        $this->modelo = new Categoria();
    }

    public function Inicio(){
        
        require_once "vistas/header.php";
        require_once "vistas/categorias/index.php";
        require_once "vistas/footer.php";
    }

    public function Form()
    {
        $categoria = new Categoria();
        $tituloFormulario = "Crear";

        if(isset($_GET['id']))
        {
           $categoria = $this->modelo->ObtenerPorId($_GET['id']);
           $tituloFormulario = "Editar";
        }

        require_once "vistas/header.php";
        require_once "vistas/categorias/form.php";
        require_once "vistas/footer.php";
    }


    public function Guardar()
    {
        $categoria = new Categoria();

        $categoria->setIdCategoria(intval($_POST['id_categoria']));
        $categoria->setNombreCategoria($_POST['nombre_categoria']);
        $categoria->setDescripcionCategoria($_POST['descripcion']);

        if($categoria->getIdCategoria() == 0)
        {
            $this->modelo->Insertar($categoria);
        }
        else
        {
            $this->modelo->Actualizar($categoria);
        }


        header("location:?c=categoria");

    }

    public function Eliminar()
    {
        $this->modelo->Eliminar($_GET['id']);

        header("location:?c=categoria");
    }
}