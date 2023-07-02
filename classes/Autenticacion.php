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
            } else {
                (new Alerta())->crearAlerta('danger', 'La contraseña es incorrecta');
                return false;
            }
        }
        (new Alerta())->crearAlerta('danger', 'El usuario no existe');
        return false;
    }

    /**
     * Si esta la sesión saca el array de la super global
     * @return void
     */
    public function cerrarSesion(): void
    {
        if (isset($_SESSION['autenticado'])) {
            unset($_SESSION['autenticado']);
        }
    }

    /**
     * Verifica el rol
     * @return string Devuelve el rol si esta autenticado, en caso de que no lo lleva a iniciar sesión
     */
    public function verificacion(): string
    {
        $usuario = $_SESSION['autenticado'];
        if (isset($usuario)) {
            return $usuario['rol'];
        } else {
            header('location: ?seccion=inicio_sesion');
        }
    }
}
