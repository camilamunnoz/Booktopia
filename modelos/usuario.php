<?php 

class Usuario
{
    private $pdo;
    private $id_usuario;
    private $nombre_completo;
    private $correo;
    private $clave;
    private $id_rol;
    private $consulta_exitosa;

    public function __CONSTRUCT()
    {
        $this->pdo = BD::Conectar();        
    }

    public function getIdUsuario(){
        return intval($this->id_usuario);
    }

    public function setIdUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }


    public function getNombreCompleto(){
        return $this->nombre_completo;
    }

    public function setNombreCompleto($nombre_completo){
        $this->nombre_completo = $nombre_completo;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function setCorreo($correo){
        $this->correo = $correo;
    }

    public function getClave(){
        return $this->clave;
    }

    public function setClave($clave){
        $this->clave = $clave;
    }

    public function getIdRol(){
        return intval($this->id_rol);
    }

    public function setIdRol($id_rol){
        $this->id_rol = $id_rol;
    }

    public function getExitoso(){
        return boolval($this->consulta_exitosa);
    }

    public function setExitoso($consulta_exitosa){
        $this->consulta_exitosa = $consulta_exitosa;
    }


    public function Cantidad(){
        try {
            
            $consulta = $this->pdo->prepare("SELECT count(*) cantidad FROM usuarios;");
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Listar(){
        try {
            
            $consulta = $this->pdo->prepare("SELECT * FROM usuarios;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Insertar(Usuario $usuario)
    {
        try {
            
            $consulta = "INSERT INTO usuarios(nombre_completo, correo, clave, id_rol) VALUES(?,?,?,?);";

            $this->pdo->prepare($consulta)->execute(array(
                $usuario->getNombreCompleto(),
                $usuario->getCorreo(),
                $usuario->getClave(),
                $usuario->getIdRol()
            ));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(Usuario $usuario)
    {
        try {
            
            $consulta = "UPDATE usuarios SET 
            nombre_completo = ?, 
            correo = ?,
            clave = ?,
            id_rol = ?
            WHERE id_usuario = ?;";

            $this->pdo->prepare($consulta)
            ->execute(array(
                $usuario->getNombreCompleto(),
                $usuario->getCorreo(),
                $usuario->getClave(),
                $usuario->getIdRol(),
                $usuario->getIdUsuario()
            ));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try {
            
            $consulta = "DELETE FROM usuarios WHERE id_usuario=?;";
            
            $this->pdo->prepare($consulta)->execute(array($id));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPorId($id){
        try {
            
            $consulta = $this->pdo->prepare("SELECT * FROM usuarios WHERE id_usuario=?;");
            $consulta->execute(array($id));
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            $usuario = new Usuario();

            $usuario->setIdUsuario($resultado->id_usuario);
            $usuario->setNombreCompleto($resultado->nombre_completo);
            $usuario->setCorreo($resultado->correo);
            $usuario->setClave($resultado->clave);
            $usuario->setIdRol($resultado->id_rol);
            
            return $usuario;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Login($correo, $clave){
        

        try {
            
            $consulta = $this->pdo->prepare("SELECT * FROM usuarios WHERE correo=? AND clave=?;");
            $consulta->execute(array($correo, $clave));
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            $consultaExitosa = $consulta->rowCount() > 0;

            $usuario = new Usuario();

            $usuario->setExitoso($consultaExitosa);

            if($consultaExitosa)
            {
                $usuario->setIdUsuario($resultado->id_usuario);
                $usuario->setNombreCompleto($resultado->nombre_completo);
                $usuario->setCorreo($resultado->correo);
                $usuario->setClave($resultado->clave);
                $usuario->setIdRol($resultado->id_rol);    
            }
           
            return $usuario;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}


?>