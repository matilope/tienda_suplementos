<?php
require_once "../../functions/autoload.php";

$id = $_POST['id'] ?? false;

if ($id) {
    (new Carrito())->agregarProducto($id);
    header('location: ../../index.php?seccion=carrito');
}
