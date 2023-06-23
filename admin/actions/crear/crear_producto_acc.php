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

    header('Location: ../../index.php?seccion=admin_productos');
} catch (Exception $e) {
    die("Ha ocurrido un error al publicar el producto");
}
