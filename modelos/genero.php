<?php
class Genero{

    private $pdo;
    private $id_genero;
    private $nombre_genero;
    private $descripcion;

    public function __CONSTRUCT(){
        $this->pdo = BD::Conectar();
    }

    public function getIdGenero(){
        return intval($this->id_genero);
    }

    public function setIdGenero($id_genero){
        $this->id_genero = $id_genero;
    }

    public function getNombreGenero(){
        return $this-> nombre_genero;
    }
    
    public function setNombreGenero($nombre_genero){
        $this->nombre_genero = $nombre_genero;
    }

    public function getDescripcion(){
        return $this-> descripcion;
    }
    
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }


    public function Listar(){

        try{        

            $consulta = $this-> pdo->prepare("select * from generos;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);

        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function Insertar(Genero $genero)
    {
        try {
            
            $consulta = "INSERT INTO generos(nombre_genero, descripcion) VALUES(?,?);";

            $this->pdo->prepare($consulta)->execute(array(
                $genero->getNombreGenero(),
                $genero->getDescripcion()
            ));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(Genero $genero)
    {
        try {
            
            $consulta = "UPDATE generos SET 
            nombre_genero = ?, 
            descripcion = ? 
            WHERE id_genero = ?;";

            $this->pdo->prepare($consulta)
            ->execute(array(
                $genero->getNombreGenero(),
                $genero->getDescripcion(),
                $genero->getIdGenero()
            ));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Eliminar($id){

        try {
            
            $consulta = "DELETE FROM generos WHERE id_genero=?;";
            
            $this->pdo->prepare($consulta)->execute(array($id));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPorId($id){
        try {
            
            $consulta = $this->pdo->prepare("SELECT * FROM generos WHERE id_genero=?;");
            $consulta->execute(array($id));
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            $genero = new Genero();

            $genero->setIdGenero($resultado->id_genero);
            $genero->setNombreGenero($resultado->nombre_genero);
            $genero->setDescripcion($resultado->descripcion);
            
            return $genero;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }




}