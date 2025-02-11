<?php 


class LibrosCarrito
{
    private $pdo;
    private $id_libros_carrito;
    private $id_carrito;
    private $id_libro;
    private $cantidad_libro;

    public function __CONSTRUCT()
    {
        $this->pdo = BD::Conectar();        
    }

    public function getIdLibrosCarrito(){
        return intval($this->id_libros_carrito);
    }

    public function setIdLibrosCarrito($id_libros_carrito){
        $this->id_libros_carrito = $id_libros_carrito;
    }


    public function getIdCarrito(){
        return intval($this->id_carrito);
    }

    public function setIdCarrito($id_carrito){
        $this->id_carrito = $id_carrito;
    }


    public function getIdLibro(){
        return intval($this->id_libro);
    }

    public function setIdLibro($id_libro){
        $this->id_libro = $id_libro;
    }

    public function getCantidadLibro(){
        return intval($this->cantidad_libro);
    }

    public function setCantidadLibro($cantidad_libro){
        $this->cantidad_libro = $cantidad_libro;
    }

    public function Listar(){
        try {
            
            $consulta = $this->pdo->prepare("SELECT * FROM libros_carrito;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarPorCarrito($id_carrito){
        try {
            
            $consulta = $this->pdo->prepare("SELECT * FROM libros_carrito INNER JOIN libro ON libro.id_libro = libros_carrito.id_libro INNER JOIN categorias ON categorias.id_categoria = libro.id_categoria INNER JOIN generos ON generos.id_genero = libro.id_genero WHERE id_carrito = ?;");

            $consulta->execute(array(
                $id_carrito
            ));

            return $consulta->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Insertar(LibrosCarrito $libros_carrito)
    {
        try {
            
            $consulta = "INSERT INTO libros_carrito(id_carrito, id_libro, cantidad_libro) VALUES(?,?,?);";

            $this->pdo->prepare($consulta)->execute(array(
                $libros_carrito->getIdCarrito(),
                $libros_carrito->getIdLibro(),
                $libros_carrito->getCantidadLibro()
            ));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(LibrosCarrito $libros_carrito)
    {
        try {
            
            $consulta = "UPDATE libros_carrito SET 
            id_carrito = ?, 
            id_libro = ?, 
            cantidad_libro = ?
            WHERE id_libros_carrito = ?;";

            $this->pdo->prepare($consulta)
            ->execute(array(
                $libros_carrito->getIdCarrito(),
                $libros_carrito->getIdLibro(),
                $libros_carrito->getCantidadLibro(),
                $libros_carrito->getIdLibrosCarrito()

            ));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try {
            
            $consulta = "DELETE FROM libros_carrito WHERE id_libros_carrito=?;";
            
            $this->pdo->prepare($consulta)->execute(array($id));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPorId($id){
        try {
            
            $consulta = $this->pdo->prepare("SELECT * FROM libros_carrito WHERE id_libros_carrito=?;");
            $consulta->execute(array($id));
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            $libros_carrito = new LibrosCarrito();

            $libros_carrito->setIdCarrito($resultado->id_carrito);
            $libros_carrito->setIdLibro($resultado->id_libro);
            $libros_carrito->setCantidadLibro($resultado->cantidad_libro);
            $libros_carrito->setIdLibrosCarrito(($resultado->id_libros_carrito));
        
            
            return $libros_carrito;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPorIdLibro($id_libro, $id_carrito){
        try {
            
            $consulta = $this->pdo->prepare("SELECT * FROM libros_carrito WHERE id_libro=? AND id_carrito=?;");
            $consulta->execute(array(
                $id_libro,
                $id_carrito));
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            if($consulta->rowCount() == 0)
            {
                return null;
            }

            $libros_carrito = new LibrosCarrito();

            $libros_carrito->setIdCarrito($resultado->id_carrito);
            $libros_carrito->setIdLibro($resultado->id_libro);
            $libros_carrito->setCantidadLibro($resultado->cantidad_libro);
            $libros_carrito->setIdLibrosCarrito(($resultado->id_libros_carrito));        
            
            return $libros_carrito;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}