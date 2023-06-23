<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    (new Ingrediente())->insert(
        Utilidades::sacarAcentos($data['ingrediente'])
    );
    header('Location: ../../index.php?seccion=admin_ingredientes');
} catch (Exception $e) {
    die("Ha ocurrido un error al crear el ingrediente");
    header('Location: ../../index.php?seccion=admin_ingredientes');
}
