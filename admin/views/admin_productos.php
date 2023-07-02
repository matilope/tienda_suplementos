<?php
$productos = (new Producto())->getProductos();
$id = $_GET['id'] ?? false;
?>
<div class="rest">
    <h1>Administración de Productos</h1>
    <a href="index.php?seccion=crear/agregar_producto" class="btn btn-lg btn-primary">Crear producto</a>
    <?= (new Alerta())->getAlerta(); ?>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col" width="15%">Imagen</th>
                <th scope="col" width="20%">Titulo</th>
                <th scope="col" width="12%">Precio</th>
                <th scope="col" width="18%">Marca</th>
                <th scope="col" width="10%">Presentación</th>
                <th scope="col" width="15%">Sabores</th>
                <th scope="col" width="10%">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto) { ?>
                <tr>
                    <td><img src="../catalogo/<?= $producto->getImagen(); ?>" alt="<?= $producto->opcionesProductos(); ?>" class="img-fluid rounded shadow-sm"></td>
                    <td><?= ucfirst($producto->getTitulo()); ?></td>
                    <td style="font-weight: bold;"><?= "$" . number_format($producto->getPrecio(), 2, ",", "."); ?></td>
                    <td><?= $producto->getMarca()->getNombre(); ?></td>
                    <td><?= $producto->getPresentacion()->getNombre(); ?></td>
                    <td>
                        <?= $producto->getData("getSabores"); ?>
                    </td>
                    <td>
                        <a href="index.php?seccion=editar/editar_producto&id=<?= $producto->getId(); ?>" role="button" class="d-block btn btn-md btn-custom-warning mb-2">Editar</a>
                        <a href="index.php?seccion=admin_productos&id=<?= $producto->getId(); ?>" role="button" class="d-block btn btn-md btn-custom-danger mb-2">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php if ($id) { ?>
    <div class="modal" style="display: block;" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title h5">¿Esta seguro de esta acción?</span>
                    <a class="text-dark" role="button" href="index.php?seccion=admin_productos"><i class="bi bi-x" data-dismiss="modal" aria-label="Close"></i></a>
                </div>
                <div class="modal-body">
                    <span class="d-block mb-3">Si apretas aceptar eliminaras el producto</span>
                </div>
                <div class="modal-footer">
                    <a href="index.php?seccion=admin_productos" class="btn btn-secondary" role="button" data-dismiss="modal">Cancelar</a>
                    <a href="actions/eliminar/eliminar_producto_acc.php?id=<?= $id; ?>" class="btn btn-custom-danger" role="button">Aceptar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
<?php } ?>