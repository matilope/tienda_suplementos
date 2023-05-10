<?php
$busqueda = $_GET['nombre'];

if (!$busqueda) {
    header("Location: ../?seccion=productos&error=vacio#productos");
    exit;
}

header("Location: ../?seccion=productos&busqueda=$busqueda#productos");
exit;
