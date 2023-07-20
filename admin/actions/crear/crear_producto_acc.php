<?php
require_once "../../../functions/autoload.php";

$data = $_POST;
$file = $_FILES['imagen'];

try {
    $producto = new Producto();

    $imagen = (new Imagen())->subirImagen(__DIR__ . "/../../../catalogo", $file);

    $producto_id = $producto->insert(
        Utilidades::sacarAcentos($data['titulo']),
        $data['precio'],
        Utilidades::sacarAcentos($data['descripcion']),
        $imagen,
        $data['categoria_id'],
        $data['marca_id'],
        $data['fecha'],
        $data['presentacion_id']
    );

    if (isset($data['sabores'])) {
        foreach ($data['sabores'] as $sabor_id) {
            $producto->agregarSabores(intval($producto_id), $sabor_id);
        }
    }

    if (isset($data['ingredientes'])) {
        foreach ($data['ingredientes'] as $ingrediente_id) {
            $producto->agregarIngredientes(intval($producto_id), $ingrediente_id);
        }
    }
    (new Alerta())->crearAlerta('success', "El producto <b>{$data['titulo']}</b> se creo correctamente");
    header('Location: ../../?seccion=admin_productos');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "El producto no se pudo crear.<br /> {$e->getMessage()}");
    header('Location: ../../?seccion=admin_productos');
}
