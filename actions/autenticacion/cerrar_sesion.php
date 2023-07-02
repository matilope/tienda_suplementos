<?php
require_once "../../functions/autoload.php";
(new Autenticacion())->cerrarSesion();
header('location: ../../?seccion=productos');
