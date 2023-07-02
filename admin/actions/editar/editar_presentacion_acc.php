<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    $presentacion = (new Presentacion)->get_por_id($data['id']);
    if ($presentacion) {
        $presentacion->update(
            Utilidades::sacarAcentos($data['presentacion'])
        );
        (new Alerta())->crearAlerta('success', "La presentación <b>{$presentacion->getNombre()}</b> se editó correctamente");
    } else {
        (new Alerta())->crearAlerta('warning', "La presentación que intenta editar no existe");
    }
    header('Location: ../../?seccion=admin_presentaciones');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "La presentación no se pudo editar");
    header('Location: ../../?seccion=admin_presentaciones');
}
