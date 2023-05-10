<?php
$nombre = $_GET['nombre'];
$correo = $_GET['correo'];
$producto = $_GET['producto'];
$cantidad = $_GET['cantidad'];
$fecha = $_GET['fecha'];

foreach ($_GET as $valores) {
    if (!$valores) {
        header("Location: ../?seccion=contacto&error=vacio#respuesta");
        exit;
    }
}

if (!preg_match('/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/', $correo)) {
    header("Location: ../?seccion=contacto&error=correo#respuesta");
    exit;
}

$verificacionFecha = explode('-', $fecha);
if (!checkdate($verificacionFecha[1], $verificacionFecha[2], $verificacionFecha[0])) {
    header("Location: ../?seccion=contacto&error=fecha#respuesta");
    exit;
}

$data = ['nombre' => $nombre, 'correo' => $correo, 'producto' => $producto, 'cantidad' => $cantidad, 'fecha de retiro' => $fecha];
$queryString = http_build_query($data);

header("Location: ../?seccion=contacto&$queryString#respuesta");
exit;
