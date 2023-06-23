<?php
require_once "../../../functions/autoload.php";

$id = $_GET['id'] ?? false;

try {
    $presentacion = (new Presentacion)->get_por_id($id);
    $presentacion->delete();
    header('Location: ../../index.php?seccion=admin_presentaciones');
} catch (Exception $e) {
    die("Ha ocurrido un error al intentar eliminar la presentación");
}
