<?php
require_once "../../../functions/autoload.php";

$id = $_GET['id'] ?? false;

try {
    $ingrediente = (new Ingrediente)->get_por_id($id);
    $ingrediente->delete();
    header('Location: ../../index.php?seccion=admin_ingredientes');
} catch (Exception $e) {
    die("Ha ocurrido un error al intentar eliminar el ingrediente");
}
