<?php
require_once "../../functions/autoload.php";
$usuario_id = $_SESSION['autenticado']['id'] ?? null;

try {
    $compra = [
        "usuario_id" => $usuario_id,
        "precio_total" => (new Carrito())->getTotal(),
        "fecha" => date("Y-m-d")
    ];
    (new Carrito())->insert($compra);
    (new Carrito())->vaciarCarrito();
    header("Location: ../../index.php?seccion=panel_usuario&mensaje=felicidades");
} catch (Exception $e) {
    header("Location: ../../index.php?seccion=inicio_sesion");
}
