<?php

class Conexion
{
    private const DB_SERVER = "localhost";
    private const DB_USER = "root";
    private const DB_PASS = "";
    private const DB_NAME = "prog2_beta_tiendita_ini";
    private const DB_DSN = "mysql:host=" . self::DB_SERVER . ";dbname=" . self::DB_NAME . ";charset=utf8mb4";

    private PDO $db;

    public function __construct()
    {
        try {
            $this->db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
        } catch (Exception $e) {
            die("Se ha producido un error al conectar con la base de datos");
        }
    }

    public function getConexion(): PDO
    {
        return $this->db;
    }

    public function petition($query, $clase)
    {
        $conexion = (new self())->getConexion();
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, $clase);
        return $PDOStatement;
    }
}

$conexion = (new Conexion())->getConexion();

$query = "SELECT * FROM comics";

$PDOStatement = $conexion->prepare($query);

$PDOStatement->setFetchMode(PDO::FETCH_CLASS, 'Producto');
$PDOStatement->execute();


class Comic
{
    public function catalogo_completo()
    {
    }
}


require_once "../classes/Productos.php";
// Constante
// define("DB_SERVER", 'localhost');

const DB_SERVER = "localhost";
const DB_USER = "root";
const DB_PASS = "";
const DB_NAME = "prog2_beta_tiendita_ini";

echo "mi servidor es " . DB_SERVER;


const DB_DSN = "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8mb4";
try {
    $conexion = new PDO(DB_DSN, DB_USER, DB_PASS);
} catch (Exception $e) {
    echo "No funco " . $e;
    // die;
    //echo $e->getFile();
    echo "<p>Hubo un error ... bla bla</p>";
    die('<p>No se pudo conectar a la base de datos</p>');
    // exit('');
}

$query = "SELECT * FROM comics";

$PDOStatement = $conexion->prepare($query);
// $PDOStatement->setFetchMode(PDO::FETCH_ASSOC); array asociativo
$PDOStatement->setFetchMode(PDO::FETCH_CLASS, 'Producto');
$PDOStatement->execute();

/*
while ($datos  = $PDOStatement->fetch()) {
    print_r($datos);
}
*/

$datos  = $PDOStatement->fetchAll();
print_r($datos);










/*
mysqli
pdo
*/