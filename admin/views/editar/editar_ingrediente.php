<?php
$id = $_GET['id'] ?? false;
$ingrediente = (new Ingrediente())->get_por_id($id);
?>
<div class="crear-rest">
    <?php if ($ingrediente) { ?>
        <h1>Editar ingrediente</h1>
        <form action="actions/editar/editar_ingrediente_acc.php" method="POST">
            <div>
                <label for="ingrediente">Nombre del ingrediente</label>
                <input type="text" id="ingrediente" name="ingrediente" value="<?= $ingrediente->getNombre(); ?>" required />
                <input type="hidden" name="id" value="<?= $ingrediente->getId(); ?>" />
            </div>
            <button type="submit" class="btn btn-lg btn-primary">Guardar</button>
        </form>
    <?php } else { ?>
        <div class="aviso">
            <h1 class="mt-3 mb-4">El ingrediente con ese ID no se ha encontrado.</h1>
            <p class="lead mb-4">Vuelva a intentarlo yendo a la administración de ingredientes y apretando en editar</p>
            <a href="?seccion=admin_ingredientes" class="btn btn-lg btn-primary">Ir a administración</a>
        </div>
    <?php } ?>
</div>