<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    (new Presentacion())->insert(
        Utilidades::sacarAcentos($data['presentacion'])
    );
    (new Alerta())->crearAlerta('success', "La presentación <b>{$data['presentacion']}</b> se creo correctamente");
    header('Location: ../../?seccion=admin_presentaciones');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "La presentación no se pudo crear");
    header('Location: ../../?seccion=admin_presentaciones');
}
