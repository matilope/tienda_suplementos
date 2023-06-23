<?php
$id = $_GET['id'] ?? false;
$sabor = (new Sabor())->get_por_id($id);
?>
<div class="crear-rest">
    <h1>Editar sabor</h1>
    <form action="actions/editar/editar_sabor_acc.php" method="POST">
        <div>
            <label for="sabor">Nombre del sabor</label>
            <input type="text" id="sabor" name="sabor" value="<?= $sabor->getNombre(); ?>" required />
            <input type="hidden" name="id" value="<?= $sabor->getId(); ?>" />
        </div>
        <button type="submit" class="btn btn-lg btn-primary">Guardar</button>
    </form>
</div>