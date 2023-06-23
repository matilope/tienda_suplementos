<?php
$id = $_GET['id'] ?? false;
$presentacion = (new Presentacion())->get_por_id($id);
?>
<div class="crear-rest">
    <h1>Editar presentación</h1>
    <form action="actions/editar/editar_presentacion_acc.php" method="POST">
        <div>
            <label for="presentacion">Nombre de la presentación</label>
            <input type="text" id="presentacion" name="presentacion" value="<?= $presentacion->getNombre(); ?>" required />
            <input type="hidden" name="id" value="<?= $presentacion->getId(); ?>" />
        </div>
        <button type="submit" class="btn btn-lg btn-primary">Guardar</button>
    </form>
</div>