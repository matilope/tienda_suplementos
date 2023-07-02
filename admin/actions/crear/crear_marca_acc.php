<?php
require_once "../../../functions/autoload.php";

$data = $_POST;

try {
    (new Marca())->insert(
        Utilidades::sacarAcentos($data['nombre'])
    );
    (new Alerta())->crearAlerta('success', "La marca <b>{$data['nombre']}</b> se creo correctamente");
    header('Location: ../../?seccion=admin_marcas');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "La marca no se pudo crear");
    header('Location: ../../?seccion=admin_marcas');
}
