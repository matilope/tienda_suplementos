<?php
require_once "../../../functions/autoload.php";

$id = $_GET['id'] ?? false;

try {
    $ingrediente = (new Ingrediente())->get_por_id($id);
    if ($ingrediente) {
        $ingrediente->delete();
        (new Alerta())->crearAlerta('success', "El ingrediente <b>{$ingrediente->getNombre()}</b> se eliminó correctamente");
    } else {
        (new Alerta())->crearAlerta('warning', "El ingrediente que intenta eliminar no existe");
    }
    header('Location: ../../?seccion=admin_ingredientes');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "El ingrediente no se puede eliminar ya que se esta usando en los productos.<br /> {$e->getMessage()}");
    header('Location: ../../?seccion=admin_ingredientes');
}
