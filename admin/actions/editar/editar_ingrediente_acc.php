<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    $ingrediente = (new Ingrediente)->get_por_id($data['id']);
    $ingrediente->update(
        Utilidades::sacarAcentos($data['ingrediente'])
    );
    header('Location: ../../index.php?seccion=admin_ingredientes');
} catch (Exception $e) {
    die("Ha ocurrido un error al editar el ingrediente");
}
