<?php

class BD
{

    const servidor="localhost:3306";
    const usuario="root";
    const clave="2610";
    const nombre="booktopia";

    public static function Conectar()
    {
        try 
        {
           $conexion = new PDO("mysql:host=".self::servidor.";dbname=".self::nombre.";charset=utf8", self::usuario, self::clave);

           $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

           return $conexion;
        }
        catch (PDOException $e)
        {
            echo "Conexion fallida: " . $e->getMessage();
        }
    }

}