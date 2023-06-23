<?php
$titulo = strtolower($_GET['titulo']);
header("Location: ../index.php?seccion=productos&buscador=$titulo");
