<?php

class Usuario
{
    private $id;
    private $nombre;
    private $correo;
    private $usuario;
    private $password;
    private $avatar;
    private $rol;


    /**
     * Inserta un usuario en la base de datos
     * @param string $nombre
     * @param string $correo
     * @param string $usuario
     * @param string $password
     * @param string $avatar
     * @param string $rol
     */
    public function insert(string $nombre, string $correo, string $usuario, string $password, string $avatar, string $rol): void
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO usuarios VALUES (null, ?, ?, ?, ?, ?, ?)";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$nombre, $correo, $usuario, $password, $avatar, $rol]);
    }

    /**
     * Devuelve todos los usuarios
     * @return Usuario[]
     */
    public function getUsuarios(): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM usuarios";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        return $PDOStatement->fetchAll() ?: [];
    }

    /**
     * Filtra un usuario único
     * @param string $usuario
     * @return Usuario|null
     */
    public function filtradoUsuario(string $usuario): ?Usuario
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM usuarios WHERE usuario = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$usuario]);
        return $PDOStatement->fetch() ?: null;
    }

    /**
     * Filtra un usuario único
     * @param int $id
     * @return Usuario|null
     */
    public function filtradoId(int $id): ?Usuario
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM usuarios WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);
        return $PDOStatement->fetch() ?: null;
    }

    /**
     * Getter del Id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Getter del nombre
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Getter del correo
     */
    public function getCorreo(): string
    {
        return $this->correo;
    }

    /**
     * Getter del usuario
     */
    public function getUsuario(): string
    {
        return $this->usuario;
    }

    /**
     * Getter de la contraseña
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Getter del avatar
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * Getter del rol
     */
    public function getRol(): string
    {
        return $this->rol;
    }
}
