<?php
$id = $_GET['id'] ?? false;
$ingrediente = (new Ingrediente())->get_por_id($id);
?>
<div class="crear-rest">
    <h1>Editar ingrediente</h1>
    <form action="actions/editar/editar_ingrediente_acc.php" method="POST">
        <div>
            <label for="ingrediente">Nombre del ingrediente</label>
            <input type="text" id="ingrediente" name="ingrediente" value="<?= $ingrediente->getNombre(); ?>" required />
            <input type="hidden" name="id" value="<?= $ingrediente->getId(); ?>" />
        </div>
        <button type="submit" class="btn btn-lg btn-primary">Guardar</button>
    </form>
</div>