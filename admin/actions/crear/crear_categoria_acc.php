<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    (new Categoria())->insert(
        Utilidades::sacarAcentos($data['categoria'])
    );
    (new Alerta())->crearAlerta('success', "La categoría <b>{$data['categoria']}</b> se creo correctamente");
    header('Location: ../../?seccion=admin_categorias');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "La categoría no se pudo crear.<br /> {$e->getMessage()}");
    header('Location: ../../?seccion=admin_categorias');
}
