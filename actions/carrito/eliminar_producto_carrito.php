<?php
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? false;

if ($id) {
    (new Carrito())->eliminarProducto($id);
    header('location: ../../index.php?seccion=carrito');
}
