<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    $presentacion = (new Presentacion)->get_por_id($data['id']);
    $presentacion->update(
        Utilidades::sacarAcentos($data['presentacion'])
    );
    header('Location: ../../index.php?seccion=admin_presentaciones');
} catch (Exception $e) {
    die("Ha ocurrido un error al editar la presentacion");
}
