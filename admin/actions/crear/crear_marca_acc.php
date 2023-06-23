<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    (new Marca())->insert(
        Utilidades::sacarAcentos($data['nombre'])
    );
    header('Location: ../../index.php?seccion=admin_marcas');
} catch (Exception $e) {
    die("Ha ocurrido un error al crear la marca");
    header('Location: ../../index.php?seccion=admin_marcas');
}
