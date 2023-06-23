<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    $categoria = (new Categoria)->get_por_id($data['id']);
    $categoria->update(
        Utilidades::sacarAcentos($data['categoria'])
    );
    header('Location: ../../index.php?seccion=admin_categorias');
} catch (Exception $e) {
    die("Ha ocurrido un error al editar la categoria");
}
