<?php
require_once("./classes/Productos.php");
$clase = new Producto();

$seccionesValidas = ["inicio", "productos", "producto", "contacto", "autor", "404"];

$seccion = $_GET['seccion'] ?? "inicio";

if (!in_array($seccion, $seccionesValidas)) {
    $vista = "404";
} else {
    $vista = $seccion;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nutrición Patria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link href="estilos/estilos.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="imagenes/logo/favicon.png" />
    <?php
    if ($vista == '404') { ?>
        <meta name="robots" content="noindex, nofollow" />
    <?php } ?>
</head>

<body>
    <nav>
        <div class="container">
            <a href="?seccion=inicio"><img src="imagenes/logo/logo.png" alt="Logo de la página de Nutrición Patria, una tienda de suplementos" /></a>
            <ul>
                <li><a href="?seccion=productos">Productos</a></li>
                <li><a href="?seccion=contacto">Contacto</a></li>
                <li><a href="?seccion=autor">Alumno</a></li>
            </ul>
            <div class="menu-btn" role="button">
                <span></span>
            </div>
        </div>
    </nav>
    <?php
    if ($vista !== '404') {
    ?>
        <div class="banner">
            <img src="imagenes/banner/icono-banner.png" alt="Icono de pesa blanca" />
            <h1>Nutrición Patria</h1>
        </div>

        <main class="container my-5" id="main">
            <section class="row">
                <?php
                require_once "views/$vista.php";
                ?>
            </section>
        </main>
    <?php } else {
        require_once "views/$vista.php";
    } ?>
    <footer>
        <div class="text-center py-4">
            <ul>
                <li><a href="https://facebook.com" title="facebook"><i class="bi bi-facebook"></i></a></li>
                <li><a href="https://instagram.com" title="instagram"><i class="bi bi-instagram"></i></a></li>
                <li><a href="https://wa.me/5491111111111" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
            </ul>
            <p class="lead">Copyright © 2023 - Nutrición Patria</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        // No quise usar el nav de bootstrap, asi que lo cree yo y ademas aplique codigo muy simple en js para resolverlo
        const menuBtn = document.querySelector('.menu-btn');
        const navMenu = document.querySelector('nav ul');
        menuBtn.addEventListener('click', () => {
            menuBtn.classList.toggle('active');
            navMenu.classList.toggle('show');
        });
    </script>
</body>

</html>