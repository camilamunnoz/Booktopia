<?php

require_once "modelos/libro.php";
require_once "modelos/categoria.php";
require_once "modelos/genero.php";

class LibroControlador
{

    private $modelo;
    private $genero;
    private $categoria;

    public function __CONSTRUCT()
    {
        $this->modelo = new Libro();
        $this->categoria = new Categoria();
        $this->genero = new Genero();
    }

    public function Inicio()
    {
        require_once "vistas/header.php";
        require_once "vistas/libros/index.php";
        require_once "vistas/footer.php";
    }

    public function Form()
    {
        $libro = new Libro();
        $tituloFormulario = "Crear";
        $categorias = $this->categoria->Listar();
        $generos = $this->genero->Listar();


        if (isset($_GET['id'])) {
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
        $libro->setIdGenero($_POST['id_genero']);
        $libro->setIdCategoria($_POST['id_categoria']);
        $libro->setFormato($_POST['formato']);
        $libro->setPrecio($_POST['precio']);
        $libro->setSinopsis($_POST['sinopsis']);

        if (isset($_FILES["img"])) {
            $imagen = $_FILES["img"]["tmp_name"];
            $nombre_imagen = $_FILES["img"]["name"];
            $tipo_imagen = strtolower(pathinfo($nombre_imagen, PATHINFO_EXTENSION));
            $directorio = "imagenes/";
            
        }


        if ($libro->getIdLibro() == 0) {

            $idLibro = $this->modelo->Insertar($libro);

            if (isset($_FILES["img"])) {            

                $ruta = $directorio . $idLibro . "." . $tipo_imagen;
                $libro->setIdLibro($idLibro);
                $libro->setImg($ruta);

                $this->modelo->ActualizarImagen($libro);
                
                if (!move_uploaded_file($imagen, $ruta)) {
                    echo "<div class='alert alert-danger'>Error al guardar la imagen</div>";
                }
            }

        } else {

            if (isset($_FILES["img"])) {
                $ruta = $directorio . $libro->getIdLibro() . "." . $tipo_imagen;

                if (!move_uploaded_file($imagen, $ruta)) {
                    echo "<div class='alert alert-danger'>Error al guardar la imagen</div>";
                }
                $libro->setImg($ruta);
            }
            $this->modelo->Actualizar($libro);

        }


        header("location:?c=libro");
    }

    public function Eliminar()
    {
        $libro=$this->modelo->ObtenerPorId($_GET['id']);
        $this->modelo->Eliminar($_GET['id']);
        if(file_exists($libro->getImg())){
            if(!unlink($libro->getImg())){
                throw new Exception("Error Eliminando Imagen");
            }
        }
        header("location:?c=libro");
    }
}
