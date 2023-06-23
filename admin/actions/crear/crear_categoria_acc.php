<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    (new Categoria())->insert(
        Utilidades::sacarAcentos($data['categoria'])
    );
    header('Location: ../../index.php?seccion=admin_categorias');
} catch (Exception $e) {
    die("Ha ocurrido un error al crear la categoría");
    header('Location: ../../index.php?seccion=admin_categorias');
}
