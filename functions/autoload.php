<?php
session_start();
date_default_timezone_set('America/Buenos_Aires');

function autoloadClasses($clase): void
{
    $archivo = __DIR__ . "/../classes/$clase.php";
    if (file_exists($archivo)) {
        require_once $archivo;
    } else {
        die("No se pudo cargar la clase -> $clase");
    }
}

spl_autoload_register('autoloadClasses');
