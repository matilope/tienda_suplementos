<?php
$usuario = $_SESSION['autenticado'] ?? false;
$compras = (new Compra())->getComprasUsuario($usuario['id']);
$compraRealizada = $_GET['mensaje'] ?? false;
?>
<h2>Bienvenido al panel, <?= $usuario['usuario'] ?></h2>
<p class="mb-3">Aqui vas a poder ver los productos que compraste.</p>
<?php if (!empty($compras)) { ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col" width="10%">Imagen</th>
                    <th scope="col" width="25%">Titulo</th>
                    <th scope="col" width="15%">Precio</th>
                    <th scope="col" width="15%">Marca</th>
                    <th scope="col" width="20%">Cantidades compradas</th>
                    <th scope="col" width="15%">Sabor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($compras as $items) {
                    $producto = (new Producto())->filtradoId($items['producto_id']);
                ?>
                    <tr>
                        <td><img src="catalogo/<?= $producto->getImagen(); ?>" alt="<?= $producto->opcionesProductos(); ?>" class="img-fluid rounded shadow-sm"></td>
                        <td><?= $producto->opcionesProductos(); ?></td>
                        <td style="font-weight: bold;"><?= "$" . number_format($producto->getPrecio(), 2, ",", "."); ?></td>
                        <td><?= $producto->getMarca()->getNombre(); ?></td>
                        <td><b style="color: #00856a;"><?= $items['cantidad'] > 1 ? $items['cantidad'] . " unidades" : $items['cantidad'] . " unidad" ?></b></td>
                        <td>
                            <?= $items['sabor']; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <p class="text-danger mb-3">No se ha hecho ninguna compra</p>
    <img class="img-fluid img-bienvenida" src="imagenes/administracion/bienvenida.png" alt="Bienvenido al panel de administracion, imagen decorativa" />
<?php } ?>
<?php if ($compraRealizada) { ?>
    <div class="compra-realizada-modal" tabindex="-1" role="dialog">
        <span class="h3">Felicidades por tu compra</span>
        <p>En esta página vas a poder ver todas las compras que realizas en nuestra página.<br />
            Esperamos verte pronto por nuestra web.</p>
    </div>
    <div style="z-index: 2;" class="modal-backdrop fade show"></div>
<?php } ?>
<script>
    setTimeout(() => {
        let alerta = document.querySelector(".compra-realizada-modal");
        alerta?.nextElementSibling?.remove();
        alerta?.remove();
    }, 4000);
</script>