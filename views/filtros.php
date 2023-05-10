<?php
$busqueda = $_GET['busqueda'] ?? null;
$error = $_GET['error'] ?? null;
?>

<div class="container my-3" id="productos">
    <div class="row justify-content-between align-items-start">
        <div class="col-md-12 col-lg-5 col-xl-4 buscador">
            <form action="includes/buscador.php" method="GET">
                <input type="text" placeholder="Busca por nombre.." name="nombre" required />
                <button class="btn btn-lg btn-primary" type="submit">Buscar</button>
            </form>
            <?php
            if ($busqueda) { ?>
                <div id="respuesta" class="alert alert-success mb-5 mt-0" role="alert">
                    <span>La búsqueda se realizo con éxito</span>
                </div>
            <?php }
            if ($error) { ?>
                <div id="respuesta" class="alert alert-danger mb-5 mt-0" role="alert">
                    <span>El campo no puede quedar vacío</span>
                </div>
            <?php } ?>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-8 filtrado">
            <div class="dropdown">
                <button class="btn btn-lg btn-secondary dropdown-toggle" type="button" id="precio" data-bs-toggle="dropdown" aria-expanded="false">
                    Nombre
                </button>
                <ul class="dropdown-menu" aria-labelledby="precio">
                    <li><a class="dropdown-item" href="?seccion=productos&nombre=asc#productos">Ascendiente</a></li>
                    <li><a class="dropdown-item" href="?seccion=productos&nombre=des#productos">Descendiente</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-lg btn-secondary dropdown-toggle" type="button" id="precio" data-bs-toggle="dropdown" aria-expanded="false">
                    Marca
                </button>
                <ul class="dropdown-menu" aria-labelledby="precio">
                    <li><a class="dropdown-item" href="?seccion=productos&marca=asc#productos">Ascendiente</a></li>
                    <li><a class="dropdown-item" href="?seccion=productos&marca=des#productos">Descendiente</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-lg btn-secondary dropdown-toggle" type="button" id="categorias" data-bs-toggle="dropdown" aria-expanded="false">
                    Categorias
                </button>
                <ul class="dropdown-menu" aria-labelledby="categorias">
                    <li><a class="dropdown-item" href="?seccion=productos#productos">Todos</a></li>
                    <?php
                    $categorias = [];
                    foreach ($clase->productos() as $producto) {
                        $categoria = $producto->getCategoria();
                        if (!in_array($categoria, $categorias)) {
                            array_push($categorias, $categoria);
                    ?>
                            <li><a class="dropdown-item" href="?seccion=productos&categoria=<?= lcfirst($categoria); ?>#productos"><?= $categoria ?></a></li>
                    <?php }
                    } ?>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-lg btn-secondary dropdown-toggle" type="button" id="precio" data-bs-toggle="dropdown" aria-expanded="false">
                    Precio
                </button>
                <ul class="dropdown-menu" aria-labelledby="precio">
                    <li><a class="dropdown-item" href="?seccion=productos&precio=menor#productos">Menor</a></li>
                    <li><a class="dropdown-item" href="?seccion=productos&precio=mayor#productos">Mayor</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>