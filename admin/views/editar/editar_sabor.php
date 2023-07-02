<?php
$id = $_GET['id'] ?? false;
$sabor = (new Sabor())->get_por_id($id);
?>
<div class="crear-rest">
    <?php if ($sabor) { ?>
        <h1>Editar sabor</h1>
        <form action="actions/editar/editar_sabor_acc.php" method="POST">
            <div>
                <label for="sabor">Nombre del sabor</label>
                <input type="text" id="sabor" name="sabor" value="<?= $sabor->getNombre(); ?>" required />
                <input type="hidden" name="id" value="<?= $sabor->getId(); ?>" />
            </div>
            <button type="submit" class="btn btn-lg btn-primary">Guardar</button>
        </form>
    <?php } else { ?>
        <div class="aviso">
            <h1 class="mt-3 mb-4">El sabor con ese ID no se ha encontrado.</h1>
            <p class="lead mb-4">Vuelva a intentarlo yendo a la administración de sabores y apretando en editar</p>
            <a href="?seccion=admin_sabores" class="btn btn-lg btn-primary">Ir a administración</a>
        </div>
    <?php } ?>
</div>