<?php

class Ingrediente
{
    private $id;
    private $ingrediente;


    /**
     * Inserta un nuevo ingrediente
     * @param string $ingrediente
     */
    public function insert(string $ingrediente): void
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO ingredientes VALUES (null, :ingrediente)";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'ingrediente' => $ingrediente
            ]
        );
    }

    /**
     * Actualiza un ingrediente
     * @param string $ingrediente
     */
    public function update($ingrediente): void
    {
        $conexion = Conexion::getConexion();
        $query = "UPDATE ingredientes SET ingrediente = :ingrediente WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id' => $this->id,
                'ingrediente' => $ingrediente
            ]
        );
    }

    /**
     * Elimina un ingrediente
     */
    public function delete(): void
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM ingredientes WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }

    /**
     * Devuelve todas los ingredientes
     * @return Ingrediente[]
     */
    public function getIngredientes(): array
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM ingredientes";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        return $PDOStatement->fetchAll() ?: [];
    }

    /**
     * Devuelve un ingrediente o null
     * @param int $id El id único de ingrediente
     * @return ?Presentacion 
     */
    public function get_por_id(int $id): ?Ingrediente
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM ingredientes WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute(
            [$id]
        );
        return $PDOStatement->fetch() ?: null;
    }

    /**
     * @return int Getter del id del ingrediente
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string Getter del ingrediente
     */
    public function getNombre(): string
    {
        return $this->ingrediente;
    }
}
