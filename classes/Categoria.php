<?php

class Categoria
{
  private $id;
  private $categoria;

  /**
   * Inserta una nueva categoria
   * @param string $nombre
   */
  public function insert(string $nombre): void
  {
    $conexion = Conexion::getConexion();
    $query = "INSERT INTO categorias VALUES (null, :categoria)";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute(
      [
        'categoria' => $nombre
      ]
    );
  }

  /**
   * Actualiza una categoria
   * @param string $nombre
   */
  public function update($nombre): void
  {
    $conexion = Conexion::getConexion();
    $query = "UPDATE categorias SET categoria = :categoria WHERE id = :id";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute(
      [
        'id' => $this->id,
        'categoria' => $nombre
      ]
    );
  }

  /**
   * Elimina una categoria
   */
  public function delete(): void
  {
    $conexion = Conexion::getConexion();
    $query = "DELETE FROM categorias WHERE id = ?";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute([$this->id]);
  }

  /**
   * Devuelve todas las categoria
   * @return Categoria[]
   */
  public function getCategorias(): array
  {
    $conexion = (new Conexion())->getConexion();
    $query = "SELECT * FROM categorias";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement->execute();
    return $PDOStatement->fetchAll() ?: [];
  }

  /**
   * Devuelve una categoria o null
   * @param int $id El id único de la categoria
   * @return ?Categoria 
   */
  public function get_por_id(int $id): ?Categoria
  {
    $conexion = (new Conexion())->getConexion();
    $query = "SELECT * FROM categorias WHERE id = ?";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement->execute(
      [$id]
    );
    return $PDOStatement->fetch() ?: null;
  }

  /**
   * @return int Getter del id de la categoria
   */
  public function getId(): int
  {
    return $this->id;
  }

  /**
   * @return string Getter del nombre de la categoria
   */
  public function getNombre(): string
  {
    return $this->categoria;
  }
}
