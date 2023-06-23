<?php
require_once "../../functions/autoload.php";

(new Carrito())->vaciarCarrito();
header('location: ../../index.php?seccion=carrito');
