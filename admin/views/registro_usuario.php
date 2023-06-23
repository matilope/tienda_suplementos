<div class="inicio-contenedor">
    <h1>Registrar usuario</h1>
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
            <input type="hidden" name="rol" value="superadmin" />
            <button type="submit" class="btn btn-lg btn-primary">Registrarse</button>
        </form>
    </div>
    <a href="index.php?seccion=inicio_sesion">¿Ya tenes un usuario creado?</a>
</div>