<?php
$id = $_GET['id'] ?? false;
$categoria = (new Categoria())->get_por_id($id);
?>
<div class="crear-rest">
    <h1>Editar categoría</h1>
    <form action="actions/editar/editar_categoria_acc.php" method="POST">
        <div>
            <label for="categoria">Nombre de la categoría</label>
            <input type="text" id="categoria" name="categoria" value="<?= $categoria->getNombre(); ?>" required />
            <input type="hidden" name="id" value="<?= $categoria->getId(); ?>" />
        </div>
        <button type="submit" class="btn btn-lg btn-primary">Guardar</button>
    </form>
</div>