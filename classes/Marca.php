<?php

class Marca
{
    private $id;
    private $nombre;


    /**
     * Inserta una nueva marca
     * @param string $nombre
     */
    public function insert(string $nombre): void
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO marcas VALUES (null, :nombre)";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'nombre' => $nombre
            ]
        );
    }

    /**
     * Actualiza una marca
     * @param string $nombre
     */
    public function update($nombre): void
    {
        $conexion = Conexion::getConexion();
        $query = "UPDATE marcas SET nombre = :nombre WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id' => $this->id,
                'nombre' => $nombre
            ]
        );
    }

    /**
     * Elimina una marca
     */
    public function delete(): void
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM marcas WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }

    /**
     * Devuelve todas las marcas
     * @return Marca[]
     */
    public function getMarcas(): array
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM marcas";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        return $PDOStatement->fetchAll() ?: [];
    }

    /**
     * Devuelve una marca o null
     * @param int $id El id único de la marca
     * @return ?Marca 
     */
    public function get_por_id(int $id): ?Marca
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM marcas WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute(
            [$id]
        );
        return $PDOStatement->fetch() ?: null;
    }

    /**
     * @return int Getter del id de la marca
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string Getter del nombre de la marca
     */
    public function getNombre(): string
    {
        return strtoupper($this->nombre);
    }
}
