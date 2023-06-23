<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    $sabor = (new Sabor)->get_por_id($data['id']);
    $sabor->update(
        Utilidades::sacarAcentos($data['sabor'])
    );
    header('Location: ../../index.php?seccion=admin_sabores');
} catch (Exception $e) {
    die("Ha ocurrido un error al editar el sabor");
}
