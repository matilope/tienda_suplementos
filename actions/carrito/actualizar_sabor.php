<?php
require_once "../../functions/autoload.php";

$data = $_POST;

if (!empty($data)) {
    (new Carrito())->actualizarSabores($data['sabores']);
    header('location: ../../index.php?seccion=carrito');
}
