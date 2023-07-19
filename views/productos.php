<?php
$buscador = $_GET["busqueda"] ?? false;
$marca = $_GET["marca"] ?? false;
$categoria = $_GET["categoria"] ?? false;
$precio = $_GET["precio"] ?? false;
$pagina = $_GET["pagina"] ?? 1;

$metodo = "filtrado" . ucFirst(array_keys($_GET)[1] ?? null);

$maximo = 6;
$offset = ($pagina - 1) * $maximo;
$limit = $maximo * $pagina;

if (method_exists('Producto', $metodo)) {
    $datos = (new Producto())->$metodo(end($_GET));
    $total = null;
} else {
    $datos = (new Producto())->getProductos($offset, $limit);
    $total = (new Producto())->getTotal();
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
}
if ($total > 6) { ?>
    <nav class="paginacion" aria-label="Paginación de productos">
        <ul class="pagination pagination-lg">
            <?php for ($i = 1; $i <= ceil($total / 6); $i++) { ?>
                <li class="page-item"><a class="page-link" href="?seccion=productos&pagina=<?= $i ?>"><?= $i ?></a></li>
            <?php } ?>
        </ul>
    </nav>
<?php } ?>