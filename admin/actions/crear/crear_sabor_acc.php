<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    (new Sabor())->insert(
        Utilidades::sacarAcentos($data['sabor'])
    );
    (new Alerta())->crearAlerta('success', "El sabor <b>{$data['sabor']}</b> se creo correctamente");
    header('Location: ../../?seccion=admin_sabores');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "El sabor no se pudo crear");
    header('Location: ../../?seccion=admin_sabores');
}
