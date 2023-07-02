<?php
require_once "../../functions/autoload.php";

$data = $_POST;
$autenticado = (new Autenticacion())->inicioSesion($data['usuario'], $data['password']);

if ($autenticado) {
    $rol = $_SESSION['autenticado']['rol'] ?? false;
    if($rol === "superadmin") {
        header("Location: ../../admin");
    } else {
        header("Location: ../../?seccion=productos");
    }
} else {
    (new Autenticacion())->cerrarSesion();
    header("Location: ../../?seccion=inicio_sesion");
}