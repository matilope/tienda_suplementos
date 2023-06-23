<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    $marca = (new Marca)->get_por_id($data['id']);
    $marca->update(
        Utilidades::sacarAcentos($data['nombre'])
    );
    header('Location: ../../index.php?seccion=admin_marcas');
} catch (Exception $e) {
    die("Ha ocurrido un error al editar la marca");
}
