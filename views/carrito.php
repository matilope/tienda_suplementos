<?php
$instancia = new Carrito();
$carrito = $instancia->getCarrito();
?>
<h2 class="mb-4">Carrito</h2>
<?php if (!empty($carrito)) { ?>
  <div class="table-responsive">
    <table class="table table-bordered table-striped carrito">
      <thead>
        <tr>
          <th scope="col">Imagen</th>
          <th scope="col">Titulo</th>
          <th scope="col">Precio</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Sabores</th>
          <th scope="col">Eliminar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($carrito as $llave => $producto) {
        ?>
          <tr>
            <th class="table-img" style="max-width: 120px;" scope="row"><img src="catalogo/<?= $producto['imagen']; ?>" alt="<?= $producto['titulo']; ?>" /></th>
            <td style="min-width: 200px;"><?= $producto['titulo']; ?></td>
            <td style="min-width: 120px; font-size: 1.15rem;"><?= "$" . number_format($producto['precio'] * $producto['cantidad'], 2, ",", "."); ?></td>
            <td style="min-width: 80px;">
              <form class="form-cantidad" action="actions/carrito/actualizar_cantidad.php" method="POST">
                <label for="cantidad-producto" class="d-none">Cantidad</label>
                <div class="decrementador <?= $producto['cantidad'] <= 1 ? 'cantidad-disabled' : '' ?>">-</div>
                <input readonly id="cantidad-producto" type="number" min="1" max="5" name="cantidades[<?= $llave ?>]" value="<?= $producto['cantidad']; ?>" />
                <div class="incrementador <?= $producto['cantidad'] >= 5 ? 'cantidad-disabled' : '' ?>">+</div>
              </form>
            </td>
            <td style="min-width: 140px;">
              <form action="actions/carrito/actualizar_sabor.php" method="POST">
                <?php
                $dataSabores = (new Producto())->filtradoId($llave)->getData("getSabores");
                $sabores = explode(", ", $dataSabores);
                ?>
                <select class="select-sabores" name="sabores[<?= $llave ?>]">
                  <?php
                  foreach ($sabores as $sabor) { ?>
                    <option type="submit" <?= $sabor == $producto['sabor'] ? 'selected' : '' ?> value="<?= $sabor; ?>"><?= $sabor; ?></option>
                  <?php } ?>
                </select>
              </form>
            </td>
            <td><a href="actions/carrito/eliminar_producto_carrito.php?id=<?= $llave ?>" role="button" class="bi-trash-container"><i class="bi bi-trash2-fill"></i></a></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
  <div class="precio-total">
    <p><span style="color: rgb(33, 37, 41);">Precio total:</span> <?= "$" . number_format($instancia->getTotal(), 2, ",", "."); ?></p>
  </div>
  <hr />
  <div class="botones-contenedor-carrito">
    <a href="actions/carrito/vaciar_carrito.php" role="button" class="btn btn-lg btn-custom-danger">Vaciar Carrito</a>
    <a href="index.php?seccion=productos" role="button" class="btn btn-lg btn-custom-warning">Seguir comprando</a>
    <a href="actions/carrito/terminar_compra.php" role="button" class="btn btn-lg btn-primary">Finalizar Compra</a>
  </div>
<?php } else { ?>
  <p class="lead">No se encuentran productos en el carrito</p>
  <a class="lead" href="?seccion=productos">Ir a productos</a>
<?php } ?>

<script>
  document.querySelectorAll("select").forEach(select => {
    select.addEventListener('input', (e) => {
      e.target.parentElement.submit();
    });
  });
  document.querySelectorAll(".decrementador").forEach(decrementador => {
    decrementador.addEventListener('click', (e) => {
      let cantidad = parseInt(e.target.nextElementSibling.value);
      if (cantidad >= 2 && cantidad <= 5) {
        e.target.nextElementSibling.value = cantidad - 1;
        e.target.parentElement.submit();
      }
    });
  });
  document.querySelectorAll(".incrementador").forEach(incrementador => {
    incrementador.addEventListener('click', (e) => {
      let cantidad = parseInt(e.target.previousElementSibling.value);
      if (cantidad >= 1 && cantidad <= 4) {
        e.target.previousElementSibling.value = cantidad + 1;
        e.target.parentElement.submit();
      }
    });
  });
</script>