<?php
$id = $_GET['id'] ?? false;
$marca = (new Marca())->get_por_id($id);
?>
<div class="crear-rest">
    <h1>Editar marca</h1>
    <form action="actions/editar/editar_marca_acc.php" method="POST">
        <div>
            <label for="nombre">Nombre de la marca</label>
            <input type="text" id="nombre" name="nombre" value="<?= $marca->getNombre(); ?>" required />
            <input type="hidden" name="id" value="<?= $marca->getId(); ?>" />
        </div>
        <button type="submit" class="btn btn-lg btn-primary">Guardar</button>
    </form>
</div>