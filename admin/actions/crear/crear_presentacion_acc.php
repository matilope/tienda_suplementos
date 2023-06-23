<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    (new Presentacion())->insert(
        Utilidades::sacarAcentos($data['presentacion'])
    );
    header('Location: ../../index.php?seccion=admin_presentaciones');
} catch (Exception $e) {
    die("Ha ocurrido un error al crear la presentación");
    header('Location: ../../index.php?seccion=admin_presentaciones');
}
