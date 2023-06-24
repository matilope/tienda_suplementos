<?php
$usuarios = (new Usuario())->getUsuarios();
?>
<h1>Lista de usuarios</h1>
<p class="mb-3">Aqui vas a poder ver los usuarios registrados.</p>
<?php if (!empty($usuarios)) { ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col" width="20%">Avatar</th>
                    <th scope="col" width="30%">Nombre</th>
                    <th scope="col" width="30%">Usuario</th>
                    <th scope="col" width="20%">Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario) { ?>
                    <tr>
                        <td><img src="../usuarios/<?= $usuario->getAvatar(); ?>" alt="<?= $usuario->getUsuario(); ?>" class="img-fluid rounded shadow-sm"></td>
                        <td><?= $usuario->getNombre(); ?></td>
                        <td style="font-weight: bold;"><?= $usuario->getUsuario(); ?></td>
                        <td><?= $usuario->getRol(); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <p class="text-danger mb-3">No se hay usuarios registrados</p>
    <img class="img-fluid img-bienvenida" src="../imagenes/administracion/bienvenida.png" alt="Bienvenido al panel de administracion, imagen decorativa" />
<?php } ?>