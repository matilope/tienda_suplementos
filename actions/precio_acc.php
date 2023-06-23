<?php
$precio = $_GET['precio'];
header("Location: ../index.php?seccion=productos&precio=$precio");
