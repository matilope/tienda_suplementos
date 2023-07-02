<?php
require_once "../../../functions/autoload.php";

$id = $_GET['id'] ?? false;

try {
    $marca = (new Marca())->get_por_id($id);
    if ($marca) {
        $marca->delete();
        (new Alerta())->crearAlerta('success', "La marca <b>{$marca->getNombre()}</b> se eliminó correctamente");
    } else {
        (new Alerta())->crearAlerta('warning', "La marca que intenta eliminar no existe");
    }
    header('Location: ../../?seccion=admin_marcas');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "La marca no se puede eliminar ya que se esta usando en los productos");
    header('Location: ../../?seccion=admin_marcas');
}
