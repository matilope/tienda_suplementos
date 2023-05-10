<?php
$identificador = $_GET['id'] ?? null;
$producto = $clase->filtradoId(intval($identificador));
?>

<?php if (!$producto) { ?>
    <div class="aviso">
        <h2 class="my-3">El producto con ese ID no se ha encontrado.</h2>
        <p class="lead">Vuelva a intentarlo yendo a la seccion de productos y apretando en el botón de "Ver más" del producto que le interesa.</p>
        <a href="?seccion=productos#productos" class="btn btn-lg btn-primary">Ir a productos</a>
    </div>
<?php } else { ?>
    <article class="col-12 my-5" id="producto">
        <div>
            <img src="<?= $producto->getImagenes()[0]; ?>" alt="<?= $producto->opcionesProductos([$producto])[0]; ?>">
            <span><?= $producto->getPeso(); ?></span>
        </div>
        <div>
            <h2><?= $producto->getNombre(); ?></h2>
            <span class="marca"><?= $producto->getMarca(); ?></span>
            <span class="sabores"><span>Sabores disponibles:</span> <?= $producto->getSabores() ?></span>
            <p class="lead my-3"><?= $producto->getDescripcion(INF, true); ?></p>
            <span class="precio">$<?= $producto->getPrecio(); ?></span>
            <a href="?seccion=contacto&id=<?= $producto->getId(); ?>#contacto" class="btn btn-lg btn-custom mt-4">Contactar</a>
            <span class="fecha">Fecha de publicación: <?= $producto->getFecha()->format('Y-m-d'); ?></span>
        </div>
    </article>
<?php } ?>