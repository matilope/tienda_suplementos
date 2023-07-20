<?php
$resultadoFormulario = $_GET ?? null;
unset($resultadoFormulario['seccion']);
$datos = (new Producto())->getProductos(0, PHP_INT_MAX);
?>

<?php if ($resultadoFormulario) { ?>
    <div id="respuesta" class="alert alert-success mb-5 mt-0" role="alert">
        <h2>Tu consulta se ha enviado correctamente</h2>
        <p class="lead">Pronto nos estaremos comunicando con usted</p>
        <ul>
            <?php foreach ($resultadoFormulario as $key => $value) { ?>
                <li><?= ucfirst(str_replace("_", " ", $key)) . ": $value" ?></li>
            <?php } ?>
        </ul>
    </div>
<?php }
echo (new Alerta())->getAlerta();
?>
<div id="contacto">
    <div class="col-6">
        <h2>Formulario</h2>
        <p class="lead">Realizá una consulta</p>
        <form action="./actions/procesamiento_datos.php" method="GET" class="col-6">
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required />
            </div>
            <div>
                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo" required />
            </div>
            <div>
                <label for="opciones">Selecciona el producto</label>
                <select type="text" id="opciones" name="producto">
                    <option selected value="No quiero consulta sobre el stock de un producto">No quiero consultar stock de un producto</option>
                    <?php
                    foreach ($datos as $producto) {
                    ?>
                        <option value="<?= $producto->opcionesProductos(); ?>"><?= $producto->opcionesProductos(); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label for="consulta">Consulta</label>
                <textarea name="consulta" id="consulta" cols="30" rows="4" placeholder="Escribí tu consulta.."></textarea>
            </div>

            <button class="btn btn-lg mt-4 btn-custom" type="submit">Enviar</button>
        </form>
    </div>
    <div class="col-6">
        <img src="imagenes/contacto/contacto.png" alt="Personas caricaturescas abriendo regalos" />
        <ul>
            <li><i class="bi bi-pin-map-fill"></i> <a href="https://google.com/maps/place/Av.+del+Libertador+3604,+Buenos+Aires/" target="_blank">Avenida Libertador 3604, CABA</a></li>
            <li><i class="bi bi-telephone-inbound-fill"></i> <a href="tel:+541112345678">+541112345678</a></li>
            <li><i class="bi bi-envelope-check-fill"></i> <a href="mailto:compras@nutricionpatria.com">compras@nutricionpatria.com</a></li>
        </ul>
    </div>
</div>