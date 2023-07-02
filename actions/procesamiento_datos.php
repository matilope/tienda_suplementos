<?php
require_once "../functions/autoload.php";

$nombre = $_GET['nombre'];
$correo = $_GET['correo'];
$producto = $_GET['producto'];
$consulta = $_GET['consulta'];

foreach ($_GET as $valores) {
    if (!$valores) {
        (new Alerta())->crearAlerta('warning', 'Los campos del formulario no pueden estar vacios');
        header("Location: ../?seccion=contacto");
        exit;
    }
}

if (!preg_match('/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/', $correo)) {
    (new Alerta())->crearAlerta('danger', 'El correo no esta en el formato correcto, ejemplo: <b>nombre@gmail.com</b>');
    header("Location: ../?seccion=contacto");
    exit;
}

$data = ['nombre' => $nombre, 'correo' => $correo, 'producto' => $producto, 'consulta' => $consulta];
$queryString = http_build_query($data);

header("Location: ../?seccion=contacto&$queryString#respuesta");
exit;
