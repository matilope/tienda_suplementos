<?php
$ingredientes = (new Ingrediente())->getIngredientes();
$id = $_GET['id'] ?? false;
?>
<div class="rest">
    <h1>Administración de Ingredientes</h1>
    <a href="index.php?seccion=crear/agregar_ingrediente" class="btn btn-lg btn-primary">Crear ingrediente</a>
</div>
<div class="table-rest table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
                <th scope="col" width="20%">Id</th>
                <th scope="col" width="50%">Nombre</th>
                <th scope="col" width="30%">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ingredientes as $ingrediente) { ?>
                <tr>
                    <td><?= $ingrediente->getId(); ?></td>
                    <td><?= $ingrediente->getNombre(); ?></td>
                    <td>
                        <a href="index.php?seccion=editar/editar_ingrediente&id=<?= $ingrediente->getId(); ?>" role="button" role="button" class="d-block btn btn-md btn-custom-warning mb-2">Editar</a>
                        <a href="index.php?seccion=admin_ingredientes&id=<?= $ingrediente->getId(); ?>" role="button" class="d-block btn btn-md btn-custom-danger mb-2">Eliminar</a>
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
                    <a class="text-dark" role="button" href="index.php?seccion=admin_ingredientes"><i class="bi bi-x" data-dismiss="modal" aria-label="Close"></i></a>
                </div>
                <div class="modal-body">
                    <span class="d-block mb-3">Si apretas aceptar eliminaras el ingrediente</span>
                </div>
                <div class="modal-footer">
                    <a href="index.php?seccion=admin_ingredientes" class="btn btn-secondary" role="button" data-dismiss="modal">Cancelar</a>
                    <a href="actions/eliminar/eliminar_ingrediente_acc.php?id=<?= $id; ?>" class="btn btn-custom-danger" role="button">Aceptar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
<?php } ?>