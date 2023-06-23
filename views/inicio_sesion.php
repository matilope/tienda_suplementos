<div class="inicio-contenedor">
    <h1>Iniciar sesión</h1>
    <div class="sesion">
        <form action="admin/actions/autenticacion/inicio_sesion.php?redirect=usuario" method="POST">
            <div>
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" required />
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required />
            </div>
            <button type="submit" class="btn btn-lg btn-primary">Ingresar</button>
        </form>
    </div>
    <a href="index.php?seccion=registro_usuario">¿No estas registrado?</a>
</div>