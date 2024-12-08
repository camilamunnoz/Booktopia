<?php 


class Categoria
{
    private $pdo;
    private $id_categoria;
    private $nombre_categoria;
    private $descripcion;

    public function __CONSTRUCT()
    {
        $this->pdo = BD::Conectar();        
    }

    public function getIdCategoria(){
        return intval($this->id_categoria);
    }

    public function setIdCategoria($id_categoria){
        $this->id_categoria = $id_categoria;
    }


    public function getNombreCategoria(){
        return $this->nombre_categoria;
    }

    public function setNombreCategoria($nombre_categoria){
        $this->nombre_categoria = $nombre_categoria;
    }


    public function getDescripcionCategoria(){
        return $this->descripcion;
    }

    public function setDescripcionCategoria($descripcion){
        $this->descripcion = $descripcion;
    }

    public function Cantidad(){
        try {
            
            $consulta = $this->pdo->prepare("SELECT count(*) cantidad FROM categorias;");
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Listar(){
        try {
            
            $consulta = $this->pdo->prepare("SELECT * FROM categorias;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Insertar(Categoria $categoria)
    {
        try {
            
            $consulta = "INSERT INTO categorias(nombre_categoria, descripcion) VALUES(?,?);";

            $this->pdo->prepare($consulta)->execute(array(
                $categoria->getNombreCategoria(),
                $categoria->getDescripcionCategoria()
            ));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(Categoria $categoria)
    {
        try {
            
            $consulta = "UPDATE categorias SET 
            nombre_categoria = ?, 
            descripcion = ? 
            WHERE id_categoria = ?;";

            $this->pdo->prepare($consulta)
            ->execute(array(
                $categoria->getNombreCategoria(),
                $categoria->getDescripcionCategoria(),
                $categoria->getIdCategoria()
            ));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try {
            
            $consulta = "DELETE FROM categorias WHERE id_categoria=?;";
            
            $this->pdo->prepare($consulta)->execute(array($id));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPorId($id){
        try {
            
            $consulta = $this->pdo->prepare("SELECT * FROM categorias WHERE id_categoria=?;");
            $consulta->execute(array($id));
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            $categoria = new Categoria();

            $categoria->setIdCategoria($resultado->id_categoria);
            $categoria->setNombreCategoria($resultado->nombre_categoria);
            $categoria->setDescripcionCategoria($resultado->descripcion);
            
            return $categoria;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}