<?php
$marcas = (new Marca())->getMarcas();
$categorias = (new Categoria())->getCategorias();
$presentaciones = (new Presentacion())->getPresentaciones();
$ingredientes = (new Ingrediente())->getIngredientes();
$sabores = (new Sabor())->getSabores();
?>

<div class="crear-editar-productos">
    <h1 class="mb-5">Crear producto</h1>
    <div>
        <form action="actions/crear/crear_producto_acc.php" method="POST" enctype="multipart/form-data">
            <div class="contenedor-admin-ap">
                <div class="col-sm-12 col-md-5">
                    <label for="titulo">Título</label>
                    <input type="text" id="titulo" name="titulo" required />
                </div>
                <div class="col-sm-12 col-md-5">
                    <label for="precio">Precio</label>
                    <input type="number" id="precio" name="precio" required />
                </div>
            </div>
            <div class="col-sm-12">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="5" required></textarea>
            </div>
            <div class="contenedor-admin-ap">
                <div class="col-sm-12 col-md-5">
                    <label for="imagen">Imagen</label>
                    <input type="file" id="imagen" name="imagen" required />
                </div>
                <div class="col-sm-12 col-md-5">
                    <label for="categoria_id" class="form-label">Categoría</label>
                    <select name="categoria_id" id="categoria_id">
                        <?php
                        foreach ($categorias as $categoria) { ?>
                            <option value="<?= $categoria->getId(); ?>"><?= $categoria->getNombre(); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="contenedor-admin-ap">
                <div class="col-sm-12 col-md-5">
                    <label for="marca_id" class="form-label">Marca</label>
                    <select name="marca_id" id="marca_id">
                        <?php
                        foreach ($marcas as $marca) { ?>
                            <option value="<?= $marca->getId(); ?>"><?= $marca->getNombre(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-12 col-md-5">
                    <label for="presentacion_id" class="form-label">Presentación</label>
                    <select name="presentacion_id" id="presentacion_id">
                        <?php
                        foreach ($presentaciones as $presentacion) { ?>
                            <option value="<?= $presentacion->getId(); ?>"><?= $presentacion->getNombre(); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="mt-4">
                <label class="form-label d-block">Sabores</label>
                <div class="div-iflex">
                    <?php
                    foreach ($sabores as $sabor) {
                    ?>
                        <div class="checkdiv">
                            <input class="check-productos" type="checkbox" name="sabores[]" id="sabor_<?= $sabor->getId() ?>" value="<?= $sabor->getId() ?>" />
                            <label for="sabor_<?= $sabor->getId() ?>"><?= $sabor->getNombre() ?></label>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="mt-4">
                <label class="form-label d-block">Ingredientes</label>
                <div class="div-iflex">
                    <?php
                    foreach ($ingredientes as $ingrediente) {
                    ?>
                        <div class="checkdiv">
                            <input class="check-productos" type="checkbox" name="ingredientes[]" id="ingrediente<?= $ingrediente->getId() ?>" value="<?= $ingrediente->getId() ?>" />
                            <label for="ingrediente<?= $ingrediente->getId() ?>"><?= $ingrediente->getNombre() ?></label>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <input type="hidden" class="form-control" name="fecha" value="<?= date('Y-m-d'); ?>" required />
            <button type="submit" class="btn btn-lg btn-primary mt-5">Guardar</button>
        </form>
    </div>
</div>