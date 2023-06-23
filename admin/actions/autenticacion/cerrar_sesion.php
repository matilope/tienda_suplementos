<?php
require_once "../../../functions/autoload.php";
$usuario = $_GET['usuario'] ?? false;
(new Autenticacion())->cerrarSesion();
if ($usuario) {
    header('location: ../../../index.php?seccion=productos');
} else {
    header('location: ../../index.php?seccion=inicio_sesion');
}
