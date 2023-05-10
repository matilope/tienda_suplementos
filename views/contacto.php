<?php
$resultadoFormulario = $_GET ?? null;
unset($resultadoFormulario['seccion'], $resultadoFormulario['id'], $resultadoFormulario['error']);
$idProducto = $_GET['id'] ?? null;
$error = $_GET['error'] ?? null;
?>

<?php if ($resultadoFormulario) { ?>
    <div id="respuesta" class="alert alert-success mb-5 mt-0" role="alert">
        <h2>Tu pedido se ha enviado correctamente</h2>
        <p class="lead">Pronto nos estaremos comunicando con usted</p>
        <ul>
            <?php foreach ($resultadoFormulario as $key => $value) { ?>
                <li><?= ucfirst(str_replace("_", " ", $key)) . ": $value" ?></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>

<?php if ($error) { ?>
    <div id="respuesta" class="alert alert-danger mb-5 mt-0" role="alert">
        <h2>Tu pedido no se ha enviado</h2>
        <p class="lead"><?= $error === "vacio" ? 'No puede haber campos vaciós' : ($error === "correo" ? 'El correo no tiene un formato correcto' : 'La fecha no esta compuesta por valores correctos') ?></p>
    </div>
<?php } ?>

<div id="contacto">
    <div class="col-6">
        <h2>Formulario de compra</h2>
        <p class="lead">¿Queres realizar una compra?</p>
        <form action="./includes/procesamiento_datos.php" method="GET" class="col-6">
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
                <select type="text" id="opciones" name="producto" required>
                    <?php
                    foreach ($clase->opcionesProductos($clase->productos()) as $producto) {
                    ?>
                        <option <?= $idProducto && $producto === $clase->opcionesProductos([$clase->filtradoId($idProducto)])[0] ? "selected" : '' ?> value="<?= $producto ?>"><?= $producto ?></option>
                    <?php } ?>
                </select>
                <?php
                if ($idProducto) { ?>
                    <div class="alert alert-warning" style="width: 100%;" role="alert">
                        Se seleccionó el suplemento que quieres adquirir.
                    </div>
                <?php } ?>
            </div>
            <div>
                <label for="cantidad">Cantidad</label>
                <input type="number" id="cantidad" min="1" max="5" name="cantidad" required />
            </div>
            <div>
                <label for="fecha">Fecha de retiro</label>
                <input type="date" id="fecha" name="fecha" max="2023-06-30" min="2023-05-10" required></input>
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