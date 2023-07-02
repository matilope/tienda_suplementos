<div class="inicio-contenedor">
    <h2 class="mb-3">Registrar usuario</h2>
    <?= (new Alerta())->getAlerta(); ?>
    <div class="sesion">
        <form action="actions/autenticacion/registro_usuario.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required />
            </div>
            <div>
                <label for="correo">Correo</label>
                <input type="mail" id="correo" name="correo" required />
            </div>
            <div>
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" required />
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required />
            </div>
            <div>
                <label for="avatar">Avatar</label>
                <input type="file" id="avatar" name="avatar" required />
            </div>
            <div class="form-check form-switch my-2">
                <label class="form-check-label" for="rol">Administrador</label>
                <input class="form-check-input" type="checkbox" id="rol" name="rol" />
            </div>
            <button type="submit" class="btn btn-lg btn-primary">Registrarse</button>
        </form>
    </div>
    <a href="index.php?seccion=inicio_sesion">¿Ya tenes un usuario creado?</a>
</div>