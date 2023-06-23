<?php

class Autenticacion
{

    /**
     * Verifica la contraseña y en caso de que este todo bien asigna en la sesión los datos
     * @param string $usuario
     * @param string $password
     * @return bool Si la contraseña se verfica devuelve true, y si no, false
     */
    public function inicioSesion(string $usuario, string $password): bool
    {
        $datos = (new Usuario())->filtradoUsuario($usuario);
        if ($datos) {
            if (password_verify($password, $datos->getPassword())) {
                $datosLogin['nombre'] = $datos->getNombre();
                $datosLogin['usuario'] = $datos->getUsuario();
                $datosLogin['id'] = $datos->getId();
                $datosLogin['avatar'] = $datos->getAvatar();
                $datosLogin['rol'] = $datos->getRol();
                $_SESSION['autenticado'] = $datosLogin;
                return true;
            }
        }
        return false;
    }

    /**
     * Si esta la sesión saca el array de la super global
     */
    public function cerrarSesion(): void
    {
        if (isset($_SESSION['autenticado'])) {
            unset($_SESSION['autenticado']);
        }
    }

    /**
     * Si el rol es superadmin devuelve true, en caso de no serlo significa que tiene puesto el rol de 'usuario' y en se caso lo redirigo a los productos
     * En caso de que no este autenticado puede ser que sea un admin el que quiera entrar entonces lo envío al inicio de sesión
     * @return ?bool
     */
    public function verificacionAdmin(): ?bool
    {
        $usuario = $_SESSION['autenticado'];
        if (isset($usuario)) {
            if ($usuario['rol'] == "superadmin") {
                return true;
            } else {
                header('location: ../index.php?seccion=productos');
                return null;
            }
        } else {
            header('location: index.php?seccion=inicio_sesion');
        }
    }

    /**
     * Cualquier rol tiene acceso, los administradores van a poder entrar al checkout y los usuarios tambien
     * @return bool
     */
    public function verificacion(): bool
    {
        $usuario = $_SESSION['autenticado'];
        if (isset($usuario)) {
            return true;
        } else {
            header('location: index.php?seccion=inicio_sesion');
        }
    }
}
