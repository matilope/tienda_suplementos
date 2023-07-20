<?php
require_once "../../../functions/autoload.php";

$id = $_GET['id'] ?? false;

try {
    $producto = (new Producto())->filtradoId($id);
    if ($producto) {
        $producto->eliminarSabores();
        $producto->eliminarIngredientes();
        $producto->delete();
        (new Imagen())->borrarImagen(__DIR__ . "/../../../catalogo/" . $producto->getImagen());
        (new Alerta())->crearAlerta('success', "El producto <b>{$producto->getTitulo()}</b> se eliminó correctamente");
    } else {
        (new Alerta())->crearAlerta('warning', "El producto que intenta eliminar no existe");
    }
    header('Location: ../../?seccion=admin_productos');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "Ha ocurrido un error al intentar al eliminar el producto.<br /> {$e->getMessage()}");
    header('Location: ../../?seccion=admin_productos');
}
