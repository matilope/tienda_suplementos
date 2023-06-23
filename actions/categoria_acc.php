<?php
$categoria = $_GET['categoria'];
header("Location: ../index.php?seccion=productos&categoria=$categoria");
