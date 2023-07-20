<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    (new Ingrediente())->insert(
        Utilidades::sacarAcentos($data['ingrediente'])
    );
    (new Alerta())->crearAlerta('success', "El ingrediente <b>{$data['ingrediente']}</b> se creo correctamente");
    header('Location: ../../?seccion=admin_ingredientes');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "El ingrediente no se pudo crear.<br /> {$e->getMessage()}");
    header('Location: ../../?seccion=admin_ingredientes');
}
