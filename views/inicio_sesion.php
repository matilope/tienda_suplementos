<div class="inicio-contenedor">
    <h2>Iniciar sesión</h2>
    <div class="sesion">
        <form action="actions/autenticacion/inicio_sesion.php" method="POST">
            <div>
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" required />
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required />
            </div>
            <?= (new Alerta())->getAlerta(); ?>
            <button type="submit" class="btn btn-lg btn-primary">Ingresar</button>
        </form>
    </div>
    <a href="index.php?seccion=registro_usuario">¿No estas registrado?</a>
</div>