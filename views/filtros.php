<?php
$productos = (new Producto())->getProductos();
$marcas = (new Marca())->getMarcas();
$categorias = (new Categoria())->getCategorias();
?>

<div class="container my-3">
    <div class="row justify-content-between align-items-start">
        <div class="col-md-12 col-lg-5 col-xl-4 buscador">
            <form action="actions/buscador_acc.php" method="GET">
                <input type="text" placeholder="Busca por nombre.." name="titulo" required />
                <button class="btn btn-lg btn-primary" type="submit">Buscar</button>
            </form>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-8 filtrado">
            <div class="dropdown">
                <button class="btn btn-lg btn-secondary dropdown-toggle" type="button" id="precio" data-bs-toggle="dropdown" aria-expanded="false">
                    Marca
                </button>
                <ul class="dropdown-menu" aria-labelledby="precio">
                    <?php foreach ($marcas as $marca) { ?>
                        <li>
                            <a href="actions/marca_acc.php?marca=<?= $marca->getId(); ?>" class="dropdown-item"><?= $marca->getNombre(); ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-lg btn-secondary dropdown-toggle" type="button" id="categorias" data-bs-toggle="dropdown" aria-expanded="false">
                    Categorias
                </button>
                <ul class="dropdown-menu" aria-labelledby="categorias">
                    <li><a class="dropdown-item" href="?seccion=productos">Todos</a></li>
                    <?php foreach ($categorias as $categoria) { ?>
                        <li>
                            <a href="actions/categoria_acc.php?categoria=<?= $categoria->getId(); ?>" class="dropdown-item"><?= $categoria->getNombre(); ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-lg btn-secondary dropdown-toggle" type="button" id="precio" data-bs-toggle="dropdown" aria-expanded="false">
                    Precio
                </button>
                <ul class="dropdown-menu" aria-labelledby="precio">
                    <li><a class="dropdown-item" href="?seccion=productos&precio=ASC">Menor</a></li>
                    <li><a class="dropdown-item" href="?seccion=productos&precio=DESC">Mayor</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>