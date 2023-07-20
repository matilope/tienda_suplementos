<?php

class Compra
{

  /**
   * Devuelve todas las compras
   * @return Compra[]
   */
  public function getCompras(): array
  {
    $conexion = Conexion::getConexion();
    $query = "SELECT compras.*, detalle_compra.compra_id as compra_id, detalle_compra.producto_id as producto_id, detalle_compra.precio as precio, detalle_compra.cantidad as cantidad, detalle_compra.sabor as sabor FROM compras LEFT JOIN detalle_compra ON compra_id = compras.id ORDER BY compras.id DESC;";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
    $PDOStatement->execute();
    return $PDOStatement->fetchAll() ?: [];
  }

  /**
   * Devuelve todas las compras del usuario
   * @param $usuarioId
   * @return Compra[]
   */
  public function getComprasUsuario(int $usuarioId): array
  {
    $conexion = Conexion::getConexion();
    $query = "SELECT compras.*, detalle_compra.compra_id as compra_id, detalle_compra.producto_id as producto_id, detalle_compra.precio as precio, detalle_compra.cantidad as cantidad, detalle_compra.sabor as sabor FROM compras LEFT JOIN detalle_compra ON compra_id = compras.id WHERE usuario_id = ?;";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
    $PDOStatement->execute([$usuarioId]);
    return $PDOStatement->fetchAll() ?: [];
  }
}
