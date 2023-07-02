<?php

class Presentacion
{
    private $id;
    private $presentacion;


    /**
     * Inserta una nueva presentacion
     * @param string $presentacion
     */
    public function insert(string $presentacion): void
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO presentaciones VALUES (null, :presentacion)";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'presentacion' => $presentacion
            ]
        );
    }

    /**
     * Actualiza una presentacion
     * @param string $presentacion
     */
    public function update($presentacion): void
    {
        $conexion = Conexion::getConexion();
        $query = "UPDATE presentaciones SET presentacion = :presentacion WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id' => $this->id,
                'presentacion' => $presentacion
            ]
        );
    }

    /**
     * Elimina una presentacion
     */
    public function delete(): void
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM presentaciones WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }

    /**
     * Devuelve todas las presentaciones
     * @return Presentacion[]
     */
    public function getPresentaciones(): array
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM presentaciones";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        return $PDOStatement->fetchAll() ?: [];
    }

    /**
     * Devuelve una presentación o null
     * @param int $id El id único de la presentacion
     * @return ?Presentacion 
     */
    public function get_por_id(int $id): ?Presentacion
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM presentaciones WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute(
            [$id]
        );
        return $PDOStatement->fetch() ?: null;
    }

    /**
     * @return int Getter del id de la presentación
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string Getter de la presentación
     */
    public function getNombre(): string
    {
        return $this->presentacion;
    }
}
