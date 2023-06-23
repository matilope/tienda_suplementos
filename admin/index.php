<?php
require_once "../functions/autoload.php";

$seccionesValidas = [
    "inicio_sesion" => [
        "titulo" => "Inicio de sesión",
        "restringido" => false
    ],
    "registro_usuario" => [
        "titulo" => "Registro de usuario",
        "restringido" => false
    ],
    "inicio" => [
        "titulo" => "Panel de administración",
        "restringido" => true
    ],
    "admin_productos" => [
        "titulo" => "Administración de productos",
        "restringido" => true
    ],
    "admin_marcas" => [
        "titulo" => "Administración de marcas",
        "restringido" => true
    ],
    "admin_presentaciones" => [
        "titulo" => "Administración de presentaciones",
        "restringido" => true
    ],
    "admin_sabores" => [
        "titulo" => "Administración de sabores",
        "restringido" => true
    ],
    "admin_ingredientes" => [
        "titulo" => "Administración de ingredientes",
        "restringido" => true
    ],
    "admin_categorias" => [
        "titulo" => "Administración de categorías",
        "restringido" => true
    ],
    "crear/agregar_producto" => [
        "titulo" => "Crear producto",
        "restringido" => true
    ],
    "editar/editar_producto" => [
        "titulo" => "Editar producto",
        "restringido" => true
    ],
    "crear/agregar_marca" => [
        "titulo" => "Crear marca",
        "restringido" => true
    ],
    "editar/editar_marca" => [
        "titulo" => "Editar marca",
        "restringido" => true
    ],
    "crear/agregar_presentacion" => [
        "titulo" => "Crear presentación",
        "restringido" => true
    ],
    "editar/editar_presentacion" => [
        "titulo" => "Editar presentación",
        "restringido" => true
    ],
    "crear/agregar_ingrediente" => [
        "titulo" => "Crear ingrediente",
        "restringido" => true
    ],
    "editar/editar_ingrediente" => [
        "titulo" => "Editar ingrediente",
        "restringido" => true
    ],
    "crear/agregar_sabor" => [
        "titulo" => "Crear sabor",
        "restringido" => true
    ],
    "editar/editar_sabor" => [
        "titulo" => "Editar sabor",
        "restringido" => true
    ],
    "crear/agregar_categoria" => [
        "titulo" => "Crear categoría",
        "restringido" => true
    ],
    "editar/editar_categoria" => [
        "titulo" => "Editar categoría",
        "restringido" => true
    ],
    "usuarios_registrados" => [
        "titulo" => "Usuarios registrados",
        "restringido" => true
    ]
];

$seccion = $_GET["seccion"] ?? "inicio";
$usuario = $_SESSION['autenticado'] ?? false;

if (!array_key_exists($seccion, $seccionesValidas)) {
    $vista = "../views/404";
    $titulo = "La página no existe";
} else {
    $vista = $seccion;
    if ($seccionesValidas[$seccion]['restringido']) {
        (new Autenticacion())->verificacionAdmin();
    }
    $titulo = $seccionesValidas[$seccion]['titulo'];
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $titulo ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link href="../estilos/estilos.css" rel="stylesheet" />
    <link href="estilos/admin_estilos.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="../imagenes/logo/favicon.png" />
    <meta name="robots" content="noindex, nofollow" />
</head>

<body>

    <nav>
        <div class="container">
            <a href="?seccion=inicio"><img src="../imagenes/logo/logo.png" alt="Logo de la página de Nutrición Patria, una tienda de suplementos" /></a>
            <ul>
                <?php if ($usuario) { ?>
                    <li><a href="?seccion=admin_productos">Admin productos</a></li>
                    <li><a href="?seccion=admin_marcas">Admin marcas</a></li>
                    <li><a href="?seccion=admin_categorias">Admin categorías</a></li>
                    <li><a href="?seccion=admin_presentaciones">Admin presentaciones</a></li>
                    <li><a href="?seccion=admin_sabores">Admin sabores</a></li>
                    <li><a href="?seccion=admin_ingredientes">Admin ingredientes</a></li>
                    <li><a href="?seccion=usuarios_registrados">Usuarios registrados</a></li>
                    <li><a class="cerrar-sesion" href="actions/autenticacion/cerrar_sesion.php"><i class="bi bi-box-arrow-left"></i> Cerrar sesión</a></li>
                <?php } else { ?>
                    <li><a class="iniciar-sesion" href="?seccion=inicio_sesion"><i class="bi bi-box-arrow-in-right"></i> Iniciar sesión</a></li>
                <?php } ?>
            </ul>
            <?php if ($usuario) { ?>
                <div class="menu-usuario" role="button">
                    <img src="../usuarios/<?= $usuario['avatar'] ?>" alt="<?= $usuario['usuario'] ?>" />
                </div>
            <?php } else { ?>
                <div class="menu-btn" role="button">
                    <span></span>
                </div>
            <?php } ?>
        </div>
    </nav>

    <div style="height:80px;"></div>

    <main class="container my-5">
        <?php
        require_once file_exists("views/$vista.php") ? "views/$vista.php" : "../views/404.php";
        ?>
    </main>

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
        const menuBtn = document.querySelector('.menu-btn');
        const navMenu = document.querySelector('nav ul');
        menuBtn?.addEventListener('click', () => {
            menuBtn?.classList.toggle('active');
            navMenu?.classList.toggle('show');
        });
        const menuUser = document.querySelector('.menu-usuario');
        menuUser?.addEventListener('click', () => {
            menuUser?.classList.toggle('active');
            navMenu?.classList.toggle('show');
        });
    </script>
</body>

</html>