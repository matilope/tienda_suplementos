<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    (new Sabor())->insert(
        Utilidades::sacarAcentos($data['sabor'])
    );
    header('Location: ../../index.php?seccion=admin_sabores');
} catch (Exception $e) {
    die("Ha ocurrido un error al crear la marca");
    header('Location: ../../index.php?seccion=admin_sabores');
}
