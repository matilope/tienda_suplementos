<?php
require_once "../../../functions/autoload.php";

$id = $_GET['id'] ?? false;

try {
    $presentacion = (new Presentacion())->get_por_id($id);
    if ($presentacion) {
        $presentacion->delete();
        (new Alerta())->crearAlerta('success', "La presentación <b>{$presentacion->getNombre()}</b> se eliminó correctamente");
    } else {
        (new Alerta())->crearAlerta('warning', "La presentación que intenta eliminar no existe");
    }
    header('Location: ../../?seccion=admin_presentaciones');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "La presentación no se puede eliminar ya que se esta usando en los productos.<br /> {$e->getMessage()}");
    header('Location: ../../?seccion=admin_presentaciones');
}
