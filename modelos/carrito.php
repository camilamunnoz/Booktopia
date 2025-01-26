<?php 


class Carrito
{
    private $pdo;
    private $id_carrito;
    private $id_usuario;
    private $fecha_creacion;
    private $total;

    public function __CONSTRUCT()
    {
        $this->pdo = BD::Conectar();        
    }

    public function getIdCarrito(){
        return intval($this->id_carrito);
    }

    public function setIdCarrito($id_carrito){
        $this->id_carrito = $id_carrito;
    }


    public function getIdUsuario(){
        return intval($this->id_usuario);
    }

    public function setIdUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }


    public function getFechaCreacion(){
        return $this->fecha_creacion;
    }

    public function setFechaCreacion($fecha_creacion){
        $this->fecha_creacion = $fecha_creacion;
    }

    public function getTotal(){
        return doubleval($this->total);
    }

    public function setTotal($total){
        $this->total = $total;
    }

    public function Listar(){
        try {
            
            $consulta = $this->pdo->prepare("SELECT * FROM carrito;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Insertar(Carrito $carrito)
    {
        try {
            
            $consulta = "INSERT INTO carrito(id_usuario, fecha_creacion, total) VALUES(?,?,?);";

            $this->pdo->prepare($consulta)->execute(array(
                $carrito->getIdUsuario(),
                $carrito->getFechaCreacion(),
                $carrito->getTotal()
            ));

            return $this->pdo->lastInsertId();

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(Carrito $carrito)
    {
        try {
            
            $consulta = "UPDATE carrito SET 
            id_usuario = ?, 
            fecha_creacion = ?, 
            total = ?
            WHERE id_carrito = ?;";

            $this->pdo->prepare($consulta)
            ->execute(array(
                $carrito->getIdUsuario(),
                $carrito->getFechaCreacion(),
                $carrito->getTotal()
            ));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try {
            
            $consulta = "DELETE FROM carrito WHERE id_carrito=?;";
            
            $this->pdo->prepare($consulta)->execute(array($id));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPorId($id){
        try {
            
            $consulta = $this->pdo->prepare("SELECT * FROM carrito WHERE id_carrito=?;");
            $consulta->execute(array($id));
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            $carrito = new Carrito();

            $carrito->setIdCarrito($resultado->id_carrito);
            $carrito->setIdUsuario($resultado->id_usuario);
            $carrito->setFechaCreacion($resultado->fecha_creacion);
            $carrito->setTotal($resultado->total);
            
            return $carrito;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPorIdUsuario($id_usuario){
        
        try {
            
            $consulta = $this->pdo->prepare("SELECT * FROM carrito WHERE id_usuario=?;");
            $consulta->execute(array($id_usuario));
            
            $carrito = new Carrito();

            if($consulta->rowCount() == 0)
            {

                $carrito->setIdUsuario(id_usuario);
                $carrito->setFechaCreacion(date("Y-m-d H:i:s"));
                $carrito->setTotal(0);

                $id_carrito = $this->Insertar($carrito);

                $carrito->setIdCarrito(id_carrito);
            }
            else
            {
                $resultado = $consulta->fetch(PDO::FETCH_OBJ);

                $carrito->setIdCarrito($resultado->id_carrito);
                $carrito->setIdUsuario($resultado->id_usuario);
                $carrito->setFechaCreacion($resultado->fecha_creacion);
                $carrito->setTotal($resultado->total);
            }            
            
            return $carrito;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($id_libro, $id_usuario){
        try {

            $consulta = $this->pdo->prepare(query: "SELECT id_carrito FROM carrito WHERE id_usuario=?;");
            $consulta->execute(array($id_usuario));
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}