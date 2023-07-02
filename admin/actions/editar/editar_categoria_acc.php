<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    $categoria = (new Categoria)->get_por_id($data['id']);
    $categoria->update(
        Utilidades::sacarAcentos($data['categoria'])
    );
    if ($categoria) {
        $categoria->update(
            Utilidades::sacarAcentos($data['categoria'])
        );
        (new Alerta())->crearAlerta('success', "La categoría <b>{$categoria->getNombre()}</b> se editó correctamente");
    } else {
        (new Alerta())->crearAlerta('warning', "La categoría que intenta editar no existe");
    }
    header('Location: ../../?seccion=admin_categorias');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "La categoría no se pudo editar");
    header('Location: ../../?seccion=admin_categorias');
}
