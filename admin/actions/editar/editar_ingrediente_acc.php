<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    $ingrediente = (new Ingrediente)->get_por_id($data['id']);
    if ($ingrediente) {
        $ingrediente->update(
            Utilidades::sacarAcentos($data['ingrediente'])
        );
        (new Alerta())->crearAlerta('success', "El ingrediente <b>{$ingrediente->getNombre()}</b> se editó correctamente");
    } else {
        (new Alerta())->crearAlerta('warning', "El ingrediente que intenta editar no existe");
    }
    header('Location: ../../?seccion=admin_ingredientes');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "El ingrediente no se pudo editar");
    header('Location: ../../?seccion=admin_ingredientes');
}
