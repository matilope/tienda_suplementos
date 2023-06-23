<?php
require_once "../../../functions/autoload.php";

$dataExtra = $_GET['redirect'] ?? false;
$data = $_POST;
$autenticado = (new Autenticacion())->inicioSesion($data['usuario'], $data['password']);

$redireccion = $dataExtra ? "../../../index.php?seccion=carrito" : "../../index.php?seccion=inicio";
$redireccionFalla = $dataExtra ? "../../../index.php?seccion=inicio_sesion" : "../../index.php?seccion=inicio_sesion";

if ($autenticado) {
    header("Location: $redireccion");
} else {
    (new Autenticacion())->cerrarSesion();
    header("Location: $redireccionFalla");
}
