<?php
require_once "../../functions/autoload.php";

$dataExtra = $_GET['redirect'] ?? false;
$data = $_POST;
$file = $_FILES['avatar'] ?? false;

try {
    if (!$data['password']) {
        (new Alerta())->crearAlerta('danger', "La contraseña es un campo obligatorio");
        header("Location: ../../?seccion=registro_usuario");
        exit;
    }
    if (!$file) {
        (new Alerta())->crearAlerta('danger', "La imagen es obligatoria para todos los usuarios");
        header("Location: ../../?seccion=registro_usuario");
        exit;
    }
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $avatar = (new Imagen())->subirImagen(__DIR__ . "/../../usuarios", $file);
    $rol = $data['rol'] === 'on' ? 'superadmin' : 'usuario';
    if (!$data['nombre'] || !$data['correo'] || !$data['usuario'] || !$password || !$avatar || !$rol) {
        (new Imagen())->borrarImagen(__DIR__ . "/../../usuarios/" . $avatar);
        (new Alerta())->crearAlerta('danger', "El formulario no puede tener campos vacíos");
        header("Location: ../../?seccion=registro_usuario");
        exit;
    } else {
        (new Usuario())->insert(
            $data['nombre'],
            $data['correo'],
            Utilidades::sacarAcentos($data['usuario']),
            $password,
            $avatar,
            $rol
        );
    }
    (new Alerta())->crearAlerta('success', "El usuario <b>{$data['usuario']}</b> con el rol de <b>$rol</b> se registro correctamente");
    header("Location: ../../?seccion=inicio_sesion");
} catch (Exception $e) {
    die("{$e->getMessage()}");
    (new Alerta())->crearAlerta('danger', "El usuario no se pudo crear correctamente");
    header("Location: ../../?seccion=registro_usuario");
}
