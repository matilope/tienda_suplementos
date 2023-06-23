<?php
$buscador = $_GET["buscador"] ?? false;
$marca = $_GET["marca"] ?? false;
$categoria = $_GET["categoria"] ?? false;
$precio = $_GET["precio"] ?? false;
if ($buscador) {
    $datos = (new Producto())->filtradoBusqueda(strtolower($buscador)) ?? [];
} else if ($marca) {
    $datos = (new Producto())->filtradoMarca($marca) ?? [];
} else if ($categoria) {
    $datos = (new Producto())->filtradoCategoria($categoria) ?? [];
} else if ($precio) {
    $datos = (new Producto())->filtradoPrecio($precio) ?? [];
} else {
    $datos = (new Producto())->getProductos();
}
?>

<?php require_once "filtros.php"; ?>

<h2 class="my-<?= !$datos ? 3 : '5' ?>"><?= !$datos ? 'Ha ocurrido un error' : 'Productos' ?></h2>

<?php
if (empty($datos)) { ?>
    <p class="lead">La informacion solicitada <span class="no-filtrado">no existe.</span><br />
        Intentelo nuevamente.</p>
    <?php
} else {
    foreach ($datos as $valores) { ?>
        <article class="col-sm-12 col-md-6 col-lg-4 p-3">
            <div class="tarjeta">
                <div class="imagen-contenedor">
                    <img class="card-img-top" src="catalogo/<?= $valores->getImagen(); ?>" alt="<?= $valores->opcionesProductos(); ?>">
                    <div class="contenedor-marca-peso">
                        <span><?= $valores->getMarca()->getNombre(); ?></span>
                        <span><?= $valores->getPresentacion()->getNombre(); ?></span>
                    </div>
                </div>
                <div class="tarjeta-cuerpo">
                    <h3 class="tarjeta-titulo"><?= $valores->getTitulo(); ?></h3>
                    <span class="tarjeta-categoria"><?= ucFirst($valores->getCategoria()->getNombre()); ?></span>
                    <span class="contenedor-s">
                        <span class="sabores-ingredientes">Sabores:</span>
                        <?= $valores->getData("getSabores"); ?>
                    </span>
                    <span class="contenedor-s">
                        <span class="sabores-ingredientes">Ingredientes:</span>
                        <?= $valores->getData("getIngredientes"); ?>
                    </span>
                    <p class="tarjeta-descripcion lead"><?= $valores->getDescripcion(120); ?></p>
                    <div class="contenedor-precio-btn">
                        <span class="precio"><?= "$" . number_format($valores->getPrecio(), 2, ",", "."); ?></span>
                        <a href="?seccion=producto&id=<?= $valores->getId(); ?>" class="btn btn-lg btn-outline-success">Ver más</a>
                    </div>
                </div>
            </div>
        </article>
<?php }
} ?>