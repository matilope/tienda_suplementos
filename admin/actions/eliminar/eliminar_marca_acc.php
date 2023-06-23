<?php
require_once "../../../functions/autoload.php";

$id = $_GET['id'] ?? false;

try {
    $marca = (new Marca)->get_por_id($id);
    $marca->delete();
    header('Location: ../../index.php?seccion=admin_marcas');
} catch (Exception $e) {
    die("Ha ocurrido un error al intentar eliminar la marca");
}
