<?php
$id = $_GET['id'] ?? false;
$marca = (new Marca())->get_por_id($id);
?>
<div class="crear-rest">
    <?php if ($marca) { ?>
        <h1>Editar marca</h1>
        <form action="actions/editar/editar_marca_acc.php" method="POST">
            <div>
                <label for="nombre">Nombre de la marca</label>
                <input type="text" id="nombre" name="nombre" value="<?= $marca->getNombre(); ?>" required />
                <input type="hidden" name="id" value="<?= $marca->getId(); ?>" />
            </div>
            <button type="submit" class="btn btn-lg btn-primary">Guardar</button>
        </form>
    <?php } else { ?>
        <div class="aviso">
            <h1 class="mt-3 mb-4">La marca con ese ID no se ha encontrado.</h1>
            <p class="lead mb-4">Vuelva a intentarlo yendo a la administración de marcas y apretando en editar</p>
            <a href="?seccion=admin_marcas" class="btn btn-lg btn-primary">Ir a administración</a>
        </div>
    <?php } ?>
</div>