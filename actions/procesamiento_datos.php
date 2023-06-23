<?php
$nombre = $_GET['nombre'];
$correo = $_GET['correo'];
$producto = $_GET['producto'];
$consulta = $_GET['consulta'];

foreach ($_GET as $valores) {
    if (!$valores) {
        header("Location: ../?seccion=contacto&error=vacio#respuesta");
    }
}

if (!preg_match('/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/', $correo)) {
    header("Location: ../?seccion=contacto&error=correo#respuesta");
}

$data = ['nombre' => $nombre, 'correo' => $correo, 'producto' => $producto, 'consulta' => $consulta];
$queryString = http_build_query($data);

header("Location: ../?seccion=contacto&$queryString#respuesta");
exit;
