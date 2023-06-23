<?php
$usuario = $_SESSION['autenticado'] ?? false;
$compras = (new Compra())->getCompras();
?>
<h1 class="mb-3">Bienvenido al panel de administración</h1>
<p class="mb-3">Es un placer volver a verte <b><?= $usuario = $_SESSION['autenticado']['usuario'] ?></b>.
    <br />
    En este sector vas a poder crear, editar y eliminar productos.
</p>
<?php if (!empty($compras)) { ?>
    <h2 class="mt-5 mb-4 h2">Compras realizadas en la tienda</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col" width="10%">Imagen</th>
                    <th scope="col" width="25%">Titulo</th>
                    <th scope="col" width="15%">Precio</th>
                    <th scope="col" width="15%">Usuario</th>
                    <th scope="col" width="20%">Cantidades</th>
                    <th scope="col" width="15%">Sabor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($compras as $items) {
                    $producto = (new Producto())->filtradoId($items['producto_id']);
                    $usuarioData = (new Usuario())->filtradoId($items['usuario_id']);
                ?>
                    <tr>
                        <td><img src="../catalogo/<?= $producto->getImagen(); ?>" alt="<?= $producto->opcionesProductos(); ?>" class="img-fluid rounded shadow-sm"></td>
                        <td><?= $producto->opcionesProductos(); ?></td>
                        <td style="font-weight: bold;"><?= "$" . number_format($producto->getPrecio(), 2, ",", "."); ?></td>
                        <td><?= $usuarioData->getUsuario(); ?></td>
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
    <p class="text-danger mb-3">No hay ninguna compra hecha en la tienda</p>
    <img class="img-fluid img-bienvenida" src="../imagenes/administracion/bienvenida.png" alt="Bienvenido al panel de administracion, imagen decorativa" />
<?php } ?>