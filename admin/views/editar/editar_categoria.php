<?php
$id = $_GET['id'] ?? false;
$categoria = (new Categoria())->get_por_id($id);
?>
<div class="crear-rest">
    <?php if ($categoria) { ?>
        <h1>Editar categoría</h1>
        <form action="actions/editar/editar_categoria_acc.php" method="POST">
            <div>
                <label for="categoria">Nombre de la categoría</label>
                <input type="text" id="categoria" name="categoria" value="<?= $categoria->getNombre(); ?>" required />
                <input type="hidden" name="id" value="<?= $categoria->getId(); ?>" />
            </div>
            <button type="submit" class="btn btn-lg btn-primary">Guardar</button>
        </form>
    <?php } else { ?>
        <div class="aviso">
            <h1 class="mt-3 mb-4">La categoría con ese ID no se ha encontrado.</h1>
            <p class="lead mb-4">Vuelva a intentarlo yendo a la administración de categorías y apretando en editar</p>
            <a href="?seccion=admin_categorias" class="btn btn-lg btn-primary">Ir a administración</a>
        </div>
    <?php } ?>
</div>