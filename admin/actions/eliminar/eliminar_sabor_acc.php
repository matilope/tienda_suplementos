<?php
require_once "../../../functions/autoload.php";

$id = $_GET['id'] ?? false;

try {
    $sabor = (new Sabor())->get_por_id($id);
    if ($sabor) {
        $sabor->delete();
        (new Alerta())->crearAlerta('success', "El sabor <b>{$sabor->getNombre()}</b> se eliminó correctamente");
    } else {
        (new Alerta())->crearAlerta('warning', "El sabor que intenta eliminar no existe");
    }
    header('Location: ../../?seccion=admin_sabores');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "El sabor no se puede eliminar ya que se esta usando en los productos");
    header('Location: ../../?seccion=admin_sabores');
}
