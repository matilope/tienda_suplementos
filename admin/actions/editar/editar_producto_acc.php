<?php
require_once "../../../functions/autoload.php";

$data = $_POST;
$file = $_FILES['imagen'] ?? false;

try {
    $producto = (new producto())->filtradoId($data['id']);
    if ($producto) {
        $producto->eliminarSabores();
        $producto->eliminarIngredientes();

        if (isset($data['sabores'])) {
            foreach ($data['sabores'] as $sabor_id) {
                $producto->agregarSabores(intval($data['id']), intval($sabor_id));
            }
        }

        if (isset($data['ingredientes'])) {
            foreach ($data['ingredientes'] as $ingrediente_id) {
                $producto->agregarIngredientes(intval($data['id']), intval($ingrediente_id));
            }
        }

        if (!empty($file['tmp_name'])) {
            $imagen = (new Imagen())->subirImagen(__DIR__ . "/../../../catalogo", $file);
            (new Imagen())->borrarImagen(__DIR__ . "/../../../catalogo/" . $data['imagen_original']);
        } else {
            $imagen = $data['imagen_original'];
        }

        $fechaActualizada = date('Y-m-d');

        $producto->update(
            Utilidades::sacarAcentos($data['titulo']),
            $data['precio'],
            Utilidades::sacarAcentos($data['descripcion']),
            $imagen,
            $data['categoria_id'],
            $data['marca_id'],
            $fechaActualizada,
            $data['presentacion_id']
        );
        (new Alerta())->crearAlerta('success', "El producto <b>{$producto->getTitulo()}</b> se editó correctamente");
    } else {
        (new Alerta())->crearAlerta('warning', "El producto que intenta editar no existe");
    }
    header('Location: ../../?seccion=admin_productos');
} catch (Exception $e) {
    (new Alerta())->crearAlerta('danger', "El producto no se pudo editar");
    header('Location: ../../?seccion=admin_productos');
}
