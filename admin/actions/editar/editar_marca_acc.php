<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    $marca = (new Marca)->get_por_id($data['id']);
    if ($marca) {
        $marca->update(
            Utilidades::sacarAcentos($data['nombre'])
        );
        (new Alerta())->crearAlerta('success', "La marca <b>{$marca->getNombre()}</b> se editó correctamente");
    } else {
        (new Alerta())->crearAlerta('warning', "La marca que intenta editar no existe");
    }
    header('Location: ../../?seccion=admin_marcas');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "La marca no se pudo editar.<br /> {$e->getMessage()}");
    header('Location: ../../?seccion=admin_marcas');
}
