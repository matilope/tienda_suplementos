<?php
$id = $_GET['id'] ?? false;
$producto = (new Producto())->filtradoId($id);
$marcas = (new Marca())->getMarcas();
$categorias = (new Categoria())->getCategorias();
$presentaciones = (new Presentacion())->getPresentaciones();
$ingredientes = (new Ingrediente())->getIngredientes();
$sabores = (new Sabor())->getSabores();
?>

<div class="crear-editar-productos">
    <h1 class="mb-5">Editar <?= $producto->getTitulo() ?></h1>
    <div>
        <form action="actions/editar/editar_producto_acc.php" method="POST" enctype="multipart/form-data">
            <div class="contenedor-admin-ap">
                <div class="col-sm-12 col-md-5">
                    <label for="titulo">Título</label>
                    <input type="text" id="titulo" name="titulo" value="<?= $producto->getTitulo() ?>" required />
                </div>
                <div class="col-sm-12 col-md-5">
                    <label for="precio">Precio</label>
                    <input type="number" id="precio" name="precio" value="<?= $producto->getPrecio(); ?>" required />
                </div>
            </div>
            <div class="col-sm-12">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="5" required><?= $producto->getdescripcion(120, true); ?></textarea>
            </div>
            <div class="col-sm-12 mb-4">
                <label for="categoria_id" class="form-label">Categoría</label>
                <select class="editar-categoria" name="categoria_id" id="categoria_id">
                    <?php
                    foreach ($categorias as $categoria) { ?>
                        <option <?= $categoria->getId() == $producto->getCategoria()->getId() ? "selected" : "" ?> value="<?= $categoria->getId(); ?>"><?= $categoria->getNombre(); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="contenedor-admin-ap mb-3 align-items-center">
                <div class="col-sm-12 col-md-5">
                    <label for="imagen_original">Imagen actual</label>
                    <img class="img-fluid d-block w-25 pt-3" src="../catalogo/<?= $producto->getImagen(); ?>" alt="<?= $producto->opcionesProductos(); ?>" />
                    <input type="hidden" id="imagen_original" name="imagen_original" value="<?= $producto->getImagen(); ?>" required />
                </div>
                <div class="col-sm-12 col-md-5 mt-md-0 mt-3">
                    <label for="imagen">Reemplazar imagen</label>
                    <input type="file" id="imagen" name="imagen" />
                </div>
            </div>
            <div class="contenedor-admin-ap">
                <div class="col-sm-12 col-md-5">
                    <label for="marca_id" class="form-label">Marca</label>
                    <select name="marca_id" id="marca_id">
                        <?php
                        foreach ($marcas as $marca) { ?>
                            <option <?= $marca->getId() == $producto->getMarca()->getId() ? "selected" : "" ?> value="<?= $marca->getId(); ?>"><?= $marca->getNombre(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-12 col-md-5 mt-md-0 mt-3">
                    <label for="presentacion_id" class="form-label">Presentación</label>
                    <select name="presentacion_id" id="presentacion_id">
                        <?php
                        foreach ($presentaciones as $presentacion) { ?>
                            <option <?= $presentacion->getId() == $producto->getPresentacion()->getId() ? "selected" : "" ?> value="<?= $presentacion->getId(); ?>"><?= $presentacion->getNombre(); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="mt-4">
                <label class="form-label d-block">Sabores</label>
                <div class="div-iflex">
                    <?php
                    foreach ($sabores as $sabor) {
                        $sabores_seleccionados = $producto->getData("getSabores", true);
                    ?>
                        <div class="checkdiv">
                            <input class="check-productos" type="checkbox" name="sabores[]" id="sabor_<?= $sabor->getId() ?>" value="<?= $sabor->getId() ?>" <?= in_array($sabor->getId(), $sabores_seleccionados) ? "checked" : "" ?> />
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
                        $ingredientes_seleccionados = $producto->getData("getIngredientes", true);
                    ?>
                        <div class="checkdiv">
                            <input class="check-productos" type="checkbox" name="ingredientes[]" id="ingrediente_<?= $ingrediente->getId() ?>" value="<?= $ingrediente->getId() ?>" <?= in_array($ingrediente->getId(), $ingredientes_seleccionados) ? "checked" : "" ?> />
                            <label for="ingrediente_<?= $ingrediente->getId() ?>"><?= $ingrediente->getNombre() ?></label>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <input type="hidden" name="fecha" value="<?= $producto->getFecha(); ?>" required />
            <input type="hidden" name="id" value="<?= $producto->getId() ?>" required />
            <button type="submit" class="btn btn-lg btn-primary mt-5">Editar</button>
        </form>
    </div>
</div>