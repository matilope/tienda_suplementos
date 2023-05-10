<?php
$nombre_funcion = "filtrado" . ucfirst(array_keys($_GET)[1] ?? null);
$nombre_variable = array_values($_GET)[1] ?? null;
if (method_exists($clase, $nombre_funcion)) {
    $datos = $clase->$nombre_funcion($nombre_variable);
} else {
    $datos = $clase->productos(true);
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
    foreach ($datos as $key => $valores) { ?>
        <article class="col-sm-12 col-md-6 col-lg-4 p-3">
            <div class="tarjeta">
                <div class="imagen-contenedor">
                    <picture>
                        <source srcset="<?= $valores->getImagenes()[3]; ?>" media="(max-width:768px)" />
                        <source srcset="<?= $valores->getImagenes()[2]; ?>" media="(max-width:992px)" />
                        <source srcset="<?= $valores->getImagenes()[1]; ?>" media="(max-width:1200px)" />
                        <img class="card-img-top" src="<?= $valores->getImagenes()[0]; ?>" alt="<?= $valores->opcionesProductos($datos)[$key]; ?>">
                    </picture>
                    <div class="contenedor-marca-peso">
                        <span><?= $valores->getMarca(); ?></span>
                        <span><?= $valores->getPeso(); ?></span>
                    </div>
                </div>
                <div class="tarjeta-cuerpo">
                    <h3 class="tarjeta-titulo"><?= $valores->getNombre(); ?></h3>
                    <span class="tarjeta-categoria"><?= $valores->getCategoria(); ?></span>
                    <p class="tarjeta-descripcion lead"><?= $valores->getDescripcion(120); ?></p>
                    <div class="contenedor-precio-btn">
                        <span class="precio">$<?= $valores->getPrecio(); ?></span>
                        <a href="?seccion=producto&id=<?= $valores->getId(); ?>#producto" class="btn btn-lg btn-outline-success">Ver más</a>
                    </div>
                </div>
            </div>
        </article>
<?php }
} ?>