<?php

class Sabor
{
    private $id;
    private $sabor;


    /**
     * Inserta un nuevo sabor
     * @param string $sabor
     */
    public function insert(string $sabor): void
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO sabores VALUES (null, :sabor)";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'sabor' => $sabor
            ]
        );
    }

    /**
     * Actualiza un sabor
     * @param string $sabor
     */
    public function update($sabor): void
    {
        $conexion = Conexion::getConexion();
        $query = "UPDATE sabores SET sabor = :sabor WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id' => $this->id,
                'sabor' => $sabor
            ]
        );
    }

    /**
     * Elimina un sabor
     */
    public function delete(): void
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM sabores WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }

    /**
     * Devuelve todas los sabores
     * @return Sabor[]
     */
    public function getSabores(): array
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM sabores";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        return $PDOStatement->fetchAll() ?? [];
    }

    /**
     * Devuelve un sabor o null
     * @param int $id El id único del sabor
     * @return ?Sabor 
     */
    public function get_por_id(int $id): ?Sabor
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM sabores WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute(
            [$id]
        );
        return $PDOStatement->fetch() ?? null;
    }

    /**
     * @return int Getter del id del sabor
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array Getter del nombre del sabor
     */
    public function getNombre(): string
    {
        return $this->sabor;
    }
}
