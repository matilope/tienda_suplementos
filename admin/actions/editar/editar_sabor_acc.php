<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    $sabor = (new Sabor)->get_por_id($data['id']);
    if ($sabor) {
        $sabor->update(
            Utilidades::sacarAcentos($data['sabor'])
        );
        (new Alerta())->crearAlerta('success', "El sabor <b>{$sabor->getNombre()}</b> se editó correctamente");
    } else {
        (new Alerta())->crearAlerta('warning', "El sabor que intenta editar no existe");
    }
    header('Location: ../../?seccion=admin_sabores');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "El sabor no se pudo editar.<br /> {$e->getMessage()}");
    header('Location: ../../?seccion=admin_sabores');
}
