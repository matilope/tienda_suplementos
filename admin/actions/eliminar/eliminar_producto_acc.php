<?php
require_once "../../../functions/autoload.php";

$id = $_GET['id'] ?? false;

try {
    $producto = (new Producto())->filtradoId($id);
    $producto->eliminarSabores();
    $producto->eliminarIngredientes();
    $producto->delete();
    (new Imagen())->borrarImagen(__DIR__ . "/../../../catalogo/" . $producto->getImagen());
    //(new Alerta())->add_alerta('danger', "El producto <strong>" . $producto->getTitulo() ."</strong> se eliminó correctamente");
    header('Location: ../../index.php?seccion=admin_productos');
} catch (Exception $e) {
    die("Ha ocurrido un error al intentar al eliminar el producto");
}
