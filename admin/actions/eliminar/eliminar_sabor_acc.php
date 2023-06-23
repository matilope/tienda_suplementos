<?php
require_once "../../../functions/autoload.php";

$id = $_GET['id'] ?? false;

try {
    $sabor = (new Sabor)->get_por_id($id);
    $sabor->delete();
    header('Location: ../../index.php?seccion=admin_sabores');
} catch (Exception $e) {
    die("Ha ocurrido un error al intentar eliminar el sabor");
}
