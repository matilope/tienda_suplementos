<?php
require_once "../../../functions/autoload.php";

$id = $_GET['id'] ?? false;

try {
    $categoria = (new Categoria())->get_por_id($id);
    if ($categoria) {
        $categoria->delete();
        (new Alerta())->crearAlerta('success', "La categoría <b>{$categoria->getNombre()}</b> se eliminó correctamente");
    } else {
        (new Alerta())->crearAlerta('warning', "La categoría que intenta eliminar no existe");
    }
    header('Location: ../../?seccion=admin_categorias');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "La categoría no se puede eliminar ya que se esta usando en los productos");
    header('Location: ../../?seccion=admin_categorias');
}
