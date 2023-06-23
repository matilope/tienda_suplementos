<?php

class Conexion
{
    private const DB_SERVER = "localhost";
    private const DB_USER = "root";
    private const DB_PASS = "";
    private const DB_NAME = "tienda";
    private const DB_DSN = "mysql:host=" . self::DB_SERVER . ";dbname=" . self::DB_NAME . ";charset=utf8mb4";

    private static ?PDO $db = null;

    /**
     * Crea la conexión a la base de datos
     * @return void
     */
    private static function crearConexion(): void
    {
        try {
            self::$db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ));
        } catch (Exception $e) {
            die("Ha ocurrido un error al conectar con MySQL $e");
        }
    }

    /**
     * Método que devuelve una conexión PDO
     * @return PDO
     */
    public static function getConexion(): PDO
    {
        if (self::$db === null) {
            self::crearConexion();
        }
        return self::$db;
    }
}
