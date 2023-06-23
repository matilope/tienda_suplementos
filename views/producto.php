<?php
$id = $_GET['id'] ?? false;
$producto = (new Producto())->filtradoId($id);
$carrito = (new Carrito())->getCarrito();
?>

<?php if (!$producto) { ?>
    <div class="aviso">
        <h2 class="my-3">El producto con ese ID no se ha encontrado.</h2>
        <p class="lead">Vuelva a intentarlo yendo a la seccion de productos y apretando en el botón de "Ver más" del producto que le interesa.</p>
        <a href="?seccion=productos" class="btn btn-lg btn-primary">Ir a productos</a>
    </div>
<?php } else { ?>
    <article class="col-12 my-5" id="producto">
        <div>
            <img src="catalogo/<?= $producto->getImagen(); ?>" alt="<?= $producto->opcionesProductos(); ?>">
            <span><?= $producto->getPresentacion()->getNombre(); ?></span>
        </div>
        <div>
            <h2><?= $producto->getTitulo(); ?></h2>
            <span class="marca"><?= $producto->getMarca()->getNombre(); ?></span>
            <span class="sabores">
                <span>Sabores disponibles:</span>
                <?= $producto->getData("getSabores"); ?>
            </span>
            <span class="sabores">
                <span>Ingredientes:</span>
                <?= $producto->getData("getIngredientes"); ?>
            </span>
            <p class="lead my-3"><?= $producto->getDescripcion(120, true); ?></p>
            <span class="precio"><?= "$" . number_format($producto->getPrecio(), 2, ",", "."); ?></span>
            <?php if (!array_key_exists($id, $carrito)) { ?>
                <form action="actions/carrito/agregar_carrito.php" method="POST">
                    <input type="hidden" name="id" value="<?= $id ?>" />
                    <button class="btn btn-lg btn-custom mt-4">Agregar al carrito</button>
                </form>
            <?php } else { ?>
                <button disabled class="btn btn-lg btn-custom mt-4">Agregado al carrito</button>
            <?php } ?>
            <span class="fecha">Fecha de publicación: <?= $producto->getFecha(); ?></span>
        </div>
    </article>
<?php } ?>