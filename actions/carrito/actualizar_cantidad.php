<?php
require_once "../../functions/autoload.php";

$data = $_POST;

if (!empty($data)) {
    (new Carrito())->actualizarCantidades($data['cantidades']);
    header('location: ../../index.php?seccion=carrito');
}
