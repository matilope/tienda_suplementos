<?php
$id = $_GET['id'] ?? false;
$presentacion = (new Presentacion())->get_por_id($id);
?>
<div class="crear-rest">
    <?php if ($presentacion) { ?>
        <h1>Editar presentación</h1>
        <form action="actions/editar/editar_presentacion_acc.php" method="POST">
            <div>
                <label for="presentacion">Nombre de la presentación</label>
                <input type="text" id="presentacion" name="presentacion" value="<?= $presentacion->getNombre(); ?>" required />
                <input type="hidden" name="id" value="<?= $presentacion->getId(); ?>" />
            </div>
            <button type="submit" class="btn btn-lg btn-primary">Guardar</button>
        </form>
    <?php } else { ?>
        <div class="aviso">
            <h1 class="mt-3 mb-4">La presentación con ese ID no se ha encontrado.</h1>
            <p class="lead mb-4">Vuelva a intentarlo yendo a la administración de presentaciones y apretando en editar</p>
            <a href="?seccion=admin_presentaciones" class="btn btn-lg btn-primary">Ir a administración</a>
        </div>
    <?php } ?>
</div>