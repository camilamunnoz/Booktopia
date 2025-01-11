<?php 


class Libro
{
    private $pdo;
    private $id_libro;
    private $titulo;
    private $nombre_autor;
    private $formato;
    private $precio;
    private $sinopsis;

    public function __CONSTRUCT()
    {
        $this->pdo = BD::Conectar();        
    }

    public function getIdLibro(){
        return intval($this->id_libro);
    }

    public function setIdLibro($id_libro){
        $this->id_libro = $id_libro;
    }


    public function getTitulo(){
        return $this->titulo;
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }


    public function getNombreAutor(){
        return $this->nombre_autor;
    }

    public function setNombreAutor($nombre_autor){
        $this->nombre_autor = $nombre_autor;
    }


    public function getFormato(){
        return intval($this->formato);
    }

    public function setFormato($formato){
        $this->formato = $formato;
    }


    public function getPrecio(){
        return doubleval($this->precio);
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }


    public function getSinopsis(){
        return $this->sinopsis;
    }

    public function setSinopsis($sinopsis){
        $this->sinopsis = $sinopsis;
    }

    public function Cantidad(){
        try {
            
            $consulta = $this->pdo->prepare("SELECT count(*) cantidad FROM libro;");
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Listar(){
        try {
            
            $consulta = $this->pdo->prepare("SELECT * FROM libro;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Insertar(Libro $libro)
    {
        try {
            
            $consulta = "INSERT INTO libro(titulo, nombre_autor, formato, precio, sinopsis) VALUES(?,?,?,?,?);";

            $this->pdo->prepare($consulta)->execute(array(
                $libro->getTitulo(),
                $libro->getNombreAutor(),
                $libro->getFormato(),
                $libro->getPrecio(),
                $libro->getSinopsis()
                

            ));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(Libro $libro)
    {
        try {
            
            $consulta = "UPDATE libro SET 
            titulo = ?,
            nombre_autor = ?, 
            formato = ?,
            precio = ?,
            sinopsis = ? 
            WHERE id_libro = ?;";

            $this->pdo->prepare($consulta)
            ->execute(array(
                $libro->getTitulo(),
                $libro->getNombreAutor(),
                $libro->getFormato(),
                $libro->getPrecio(),
                $libro->getSinopsis(),
                $libro->getIdLibro()
            ));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try {
            
            $consulta = "DELETE FROM libro WHERE id_libro=?;";
            
            $this->pdo->prepare($consulta)->execute(array($id));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPorId($id){
        try {
            
            $consulta = $this->pdo->prepare("SELECT * FROM libro WHERE id_libro=?;");
            $consulta->execute(array($id));
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            $libro = new Libro();

            $libro->setIdLibro($resultado->id_libro);
            $libro->setTitulo($resultado->titulo);
            $libro->setNombreAutor($resultado->nombre_autor);
            $libro->setFormato($resultado->formato);
            $libro->setPrecio($resultado->precio);
            $libro->setSinopsis($resultado->sinopsis);
            
            return $libro;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}