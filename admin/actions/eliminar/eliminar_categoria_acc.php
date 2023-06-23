<?php
require_once "../../../functions/autoload.php";

$id = $_GET['id'] ?? false;

try {
    $categoria = (new Categoria)->get_por_id($id);
    $categoria->delete();
    header('Location: ../../index.php?seccion=admin_categorias');
} catch (Exception $e) {
    die("Ha ocurrido un error al intentar eliminar la categoría");
}
