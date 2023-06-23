<?php
require_once "../../../functions/autoload.php";

$dataExtra = $_GET['redirect'] ?? false;
$data = $_POST;
$file = $_FILES['avatar'];

$redireccion = $dataExtra ? "../../../index.php?seccion=inicio_sesion" : "../../index.php?seccion=inicio_sesion";
$redireccionFalla = $dataExtra ? "../../../index.php?seccion=registro_usuario" : "../../index.php?seccion=registro_usuario";

try {
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $avatar = (new Imagen())->subirImagen(__DIR__ . "/../../../usuarios", $file);
    (new Usuario())->insert(
        $data['nombre'],
        $data['correo'],
        Utilidades::sacarAcentos($data['usuario']),
        $password,
        $avatar,
        $data['rol']
    );
    header("Location: $redireccion");
} catch (Exception $e) {
    die("Ha ocurrido un error al crear el usuario");
    header("Location: $redireccionFalla");
}
