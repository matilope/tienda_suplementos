<?php

/**
 * Representa un producto con sus propiedades privadas y métodos públicos.
 */
class Producto
{
  private $id;
  private $titulo;
  private $precio;
  private $descripcion;
  private $imagen;
  private $categoria_id;
  private $marca_id;
  private $fecha;
  private $presentacion_id;
  private $sabores;
  private $ingredientes;

  /**
   * Inserta un nuevo producto
   * @param string $titulo
   * @param float $precio
   * @param string $descripcion
   * @param string $imagen
   * @param int $categoria_id
   * @param int $marca_id
   * @param date $fecha
   * @param int $presentacion_id
   * @return string|false si falla el execute devuelve false y si no devuelve un string (siendo este el id insertado)
   */
  public function insert($titulo, $precio, $descripcion, $imagen, $categoria_id, $marca_id, $fecha, $presentacion_id): string|false
  {
    $conexion = Conexion::getConexion();
    $query = "INSERT INTO productos VALUES (null, :titulo, :precio, :descripcion, :imagen, :categoria_id, :marca_id, :fecha, :presentacion_id)";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute(
      [
        'titulo' => $titulo,
        'precio' => $precio,
        'descripcion' => $descripcion,
        'imagen' => $imagen,
        'categoria_id' => $categoria_id,
        'marca_id' => $marca_id,
        'fecha' => $fecha,
        'presentacion_id' => $presentacion_id
      ]
    );
    return $conexion->lastInsertId();
  }

  /**
   * Actualiza un producto
   * @param string $titulo
   * @param float $precio
   * @param string $descripcion
   * @param string $imagen
   * @param int $categoria_id
   * @param int $marca_id
   * @param date $fecha
   * @param int $presentacion_id
   * @return void
   */
  public function update($titulo, $precio, $descripcion, $imagen, $categoria_id, $marca_id, $fecha, $presentacion_id): void
  {
    $conexion = Conexion::getConexion();
    $query = "UPDATE productos SET titulo = :titulo, precio = :precio, descripcion = :descripcion, imagen = :imagen, categoria_id = :categoria_id, marca_id = :marca_id, fecha = :fecha, presentacion_id = :presentacion_id WHERE id = :id";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute(
      [
        'id' => $this->id,
        'titulo' => $titulo,
        'precio' => $precio,
        'descripcion' => $descripcion,
        'imagen' => $imagen,
        'categoria_id' => $categoria_id,
        'marca_id' => $marca_id,
        'fecha' => $fecha,
        'presentacion_id' => $presentacion_id
      ]
    );
  }

  /**
   * Elimina un producto
   * @return void
   */
  public function delete(): void
  {
    $conexion = Conexion::getConexion();
    $query = "DELETE FROM productos WHERE id = ?";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute([$this->id]);
  }

  /**
   * Crea el vinculo entre un producto y un sabor, agregando los valores en la tabla pivot
   * @param int $producto_id
   * @param int $sabor_id
   * @return void
   */
  public function agregarSabores(int $producto_id, int $sabor_id): void
  {
    $conexion = Conexion::getConexion();
    $query = "INSERT INTO sabores_por_producto VALUES (null, :producto_id, :sabor_id)";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute(
      [
        'producto_id' => $producto_id,
        'sabor_id' => $sabor_id
      ]
    );
    if ($this->sabores !== null) {
      array_push($this->sabores, (new Sabor())->get_por_id(intval($sabor_id)));
    }
  }

  /**
   * Elimina el vinculo entre un producto y un sabor, los saca de la tabla pivot
   * @return void
   */
  public function eliminarSabores(): void
  {
    $conexion = Conexion::getConexion();
    $query = "DELETE FROM sabores_por_producto WHERE producto_id = ?";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute(
      [$this->id]
    );
    $this->sabores = [];
  }

  /**
   * Crea el vinculo entre un producto y un ingrediente, agregando los valores en la tabla pivot
   * @param int $producto_id
   * @param int $ingrediente_id
   * @return void
   */
  public function agregarIngredientes(int $producto_id, int $ingrediente_id): void
  {
    $conexion = Conexion::getConexion();
    $query = "INSERT INTO ingredientes_por_producto VALUES (null, :producto_id, :ingrediente_id)";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute(
      [
        'producto_id' => $producto_id,
        'ingrediente_id' => $ingrediente_id
      ]
    );
    if ($this->ingredientes !== null) {
      array_push($this->ingredientes, (new Ingrediente())->get_por_id(intval($ingrediente_id)));
    }
  }

  /**
   * Elimina el vinculo entre un producto y un ingrediente, los saca de la tabla pivot
   * @return void
   */
  public function eliminarIngredientes(): void
  {
    $conexion = Conexion::getConexion();
    $query = "DELETE FROM ingredientes_por_producto WHERE producto_id = ?";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute(
      [$this->id]
    );
    $this->ingredientes = [];
  }

  /**
   * Devuelve un array con todos los productos.
   * @param int $offset el numero mínimo de resultados
   * @param int $limit el numero máximo de resultados
   * @return Producto[]
   */
  public function getProductos(int $offset, int $limit): array
  {
    $productos = [];
    $conexion = Conexion::getConexion();
    $query = "SELECT productos.*, GROUP_CONCAT(DISTINCT ingredientes_por_producto.ingrediente_id) AS ingredientes, GROUP_CONCAT(DISTINCT sabores_por_producto.sabor_id) AS sabores FROM productos LEFT JOIN sabores_por_producto ON sabores_por_producto.producto_id = productos.id LEFT JOIN ingredientes_por_producto ON ingredientes_por_producto.producto_id = productos.id GROUP BY productos.id LIMIT ? OFFSET ?;";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
    $PDOStatement->bindParam(1, $limit, PDO::PARAM_INT);
    $PDOStatement->bindParam(2, $offset, PDO::PARAM_INT);
    $PDOStatement->execute();
    while ($resultado = $PDOStatement->fetch()) {
      array_push($productos, $this->crearProducto($resultado));
    }
    return $productos;
  }

  /**
   * Devuelve la cantidad total de productos
   * @return ?int
   */
  public function getTotal(): ?int
  {
    $conexion = Conexion::getConexion();
    $query = "SELECT COUNT(*) AS total FROM productos;";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute();
    $resultado = $PDOStatement->fetch();
    if ($resultado) {
      return $resultado['total'];
    }
    return null;
  }

  /**
   * Crea el objeto Producto con sus propiedades y ademas, crea objetos de otras clases
   * @return ?Producto
   */
  public function crearProducto($data): ?Producto
  {
    if (!is_bool($data)) {
      $producto = new self();
      $producto->id = $data['id'];
      $producto->titulo = $data['titulo'];
      $producto->precio = $data['precio'];
      $producto->descripcion = $data['descripcion'];
      $producto->imagen = $data['imagen'];
      $producto->fecha = $data['fecha'];
      $producto->categoria_id = (new Categoria())->get_por_id(intval($data['categoria_id']));
      $producto->presentacion_id = (new Presentacion())->get_por_id(intval($data['presentacion_id']));
      $producto->marca_id = (new Marca())->get_por_id(intval($data['marca_id']));

      $sabores = [];
      if (!empty($data['sabores'])) {
        foreach (explode(",", $data['sabores']) as $sabor) {
          array_push($sabores, (new Sabor())->get_por_id(intval($sabor)));
        }
      }
      $producto->sabores = $sabores;

      $ingredientes = [];
      if (!empty($data['ingredientes'])) {
        foreach (explode(",", $data['ingredientes']) as $ingrediente) {
          array_push($ingredientes, (new Ingrediente())->get_por_id(intval($ingrediente)));
        }
      }
      $producto->ingredientes = $ingredientes;

      return $producto;
    }
    return null;
  }

  /**
   * Devuelve un array de tipo Producto en caso de encontrar coincidencias, si no, devuelve un array vacio
   * @param string $nombre Recibe como parametro un string.
   * @return Producto[]
   * */
  public function filtradoBusqueda(string $nombre): array
  {
    $filtrado = [];
    $conexion = Conexion::getConexion();
    $query = "SELECT productos.*, GROUP_CONCAT(DISTINCT ingredientes_por_producto.ingrediente_id) AS ingredientes, GROUP_CONCAT(DISTINCT sabores_por_producto.sabor_id) AS sabores FROM productos LEFT JOIN ingredientes_por_producto ON ingredientes_por_producto.producto_id = productos.id LEFT JOIN sabores_por_producto ON sabores_por_producto.producto_id = productos.id WHERE LOWER(titulo) LIKE CONCAT('%', ?, '%') OR LOWER(descripcion) LIKE CONCAT('%', ?, '%') GROUP BY productos.id;";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
    $PDOStatement->execute([
      $nombre,
      $nombre
    ]);
    while ($resultado = $PDOStatement->fetch()) {
      array_push($filtrado, $this->crearProducto($resultado));
    }
    return $filtrado;
  }

  /**
   * Devuelve un objeto Producto o null en caso de no encontrarlo.
   * @param int $id Recibe como parametro un integer.
   * @return ?Producto devuelve producto o null.
   * */
  public function filtradoId(int $id): ?Producto
  {
    $conexion = Conexion::getConexion();
    $query = "SELECT productos.*, GROUP_CONCAT(DISTINCT ingredientes_por_producto.ingrediente_id) AS ingredientes, GROUP_CONCAT(DISTINCT sabores_por_producto.sabor_id) AS sabores FROM productos LEFT JOIN ingredientes_por_producto ON ingredientes_por_producto.producto_id = productos.id LEFT JOIN sabores_por_producto ON sabores_por_producto.producto_id = productos.id WHERE productos.id = ? GROUP BY productos.id;";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
    $PDOStatement->execute(
      [$id]
    );
    return $this->crearProducto($PDOStatement->fetch());
  }

  /**
   * Devuelve un array de tipo Producto conteniendo productos que tienen la misma categoria que se pasa por parametro.
   * @param int $categoria_id Recibe como parametro un int.
   * @return Producto[]
   * */
  public function filtradoCategoria(int $categoria_id): array
  {
    $filtrado = [];
    $conexion = Conexion::getConexion();
    $query = "SELECT productos.*, GROUP_CONCAT(DISTINCT ingredientes_por_producto.ingrediente_id) AS ingredientes, GROUP_CONCAT(DISTINCT sabores_por_producto.sabor_id) AS sabores FROM productos LEFT JOIN ingredientes_por_producto ON ingredientes_por_producto.producto_id = productos.id LEFT JOIN sabores_por_producto ON sabores_por_producto.producto_id = productos.id WHERE categoria_id = ? GROUP BY productos.id;";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
    $PDOStatement->execute([$categoria_id]);
    while ($resultado = $PDOStatement->fetch()) {
      array_push($filtrado, $this->crearProducto($resultado));
    }
    return $filtrado;
  }

  /**
   * Devuelve un array de tipo Producto en un orden menor o mayor en cuanto al precio.
   * @param string $orden Recibe como parametro un string. Los valores que debe recibir el parametro es "ASC" o otro valor distinto, en este ultimo caso, te lo va a ordenar de mayor a menor.
   * @return Producto[]
   * */
  public function filtradoPrecio(string $orden): array
  {
    switch (strtoupper($orden)) {
      case 'ASC':
        break;
      case 'DESC':
        break;
      default:
        $orden = 'ASC';
    }
    $filtrado = [];
    $conexion = Conexion::getConexion();
    $query = "SELECT productos.*, GROUP_CONCAT(DISTINCT ingredientes_por_producto.ingrediente_id) AS ingredientes, GROUP_CONCAT(DISTINCT sabores_por_producto.sabor_id) AS sabores FROM productos LEFT JOIN ingredientes_por_producto ON ingredientes_por_producto.producto_id = productos.id LEFT JOIN sabores_por_producto ON sabores_por_producto.producto_id = productos.id GROUP BY productos.id ORDER BY precio $orden;";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
    $PDOStatement->execute();
    while ($resultado = $PDOStatement->fetch()) {
      array_push($filtrado, $this->crearProducto($resultado));
    }
    return $filtrado;
  }

  /**
   * Devuelve un array de tipo Producto.
   * @param int $marca_id
   * @return Producto[]
   * */
  public function filtradoMarca(int $marca_id): array
  {
    $filtrado = [];
    $conexion = Conexion::getConexion();
    $query = "SELECT productos.*, GROUP_CONCAT(DISTINCT ingredientes_por_producto.ingrediente_id) AS ingredientes, GROUP_CONCAT(DISTINCT sabores_por_producto.sabor_id) AS sabores FROM productos LEFT JOIN ingredientes_por_producto ON ingredientes_por_producto.producto_id = productos.id LEFT JOIN sabores_por_producto ON sabores_por_producto.producto_id = productos.id WHERE marca_id = ? GROUP BY productos.id;";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
    $PDOStatement->execute([$marca_id]);
    while ($resultado = $PDOStatement->fetch()) {
      array_push($filtrado, $this->crearProducto($resultado));
    }
    return $filtrado;
  }

  /**
   * Devuelve un array el cual cada posición va a tener un string con el nombre, la marca y el peso del producto.
   * @param array $productos Recibe como parametro un array.
   * @return array
   * */
  public function opcionesProductos(): string
  {
    return ucfirst($this->getTitulo()) . " - " . $this->getMarca()->getNombre() . " - " . $this->getPresentacion()->getNombre();
  }

  /**
   * Devuelve la propiedad privada id del producto.
   * @return int
   * */
  public function getId(): int
  {
    return $this->id;
  }

  /**
   * Devuelve la propiedad privada nombre del producto.
   * @return string
   * */
  public function getTitulo(): string
  {
    return $this->titulo;
  }

  /**
   * Devuelve un objeto Marca.
   * @return object
   * */
  public function getMarca(): object
  {
    return $this->marca_id;
  }

  /**
   * Devuelve la propiedad privada sabores del producto.
   * @return array
   * */
  public function getSabores(): array
  {
    return $this->sabores;
  }

  /**
   * Devuelve un objeto Categoria
   * @return object
   * */
  public function getCategoria(): object
  {
    return $this->categoria_id;
  }

  /**
   * Devuelve la propiedad privada precio del producto.
   * @return float
   * */
  public function getPrecio(): float
  {
    return $this->precio;
  }

  /**
   * Devuelve la propiedad privada descripcion del producto.
   * @param float $cantidad Cantidad de caracteres que debe tener.
   * @param bool $full En caso de que se pase true devuelve la descripción completa, en caso de que no devuelve una descripción parcial.
   * @return string
   * */
  public function getDescripcion(float $cantidad, bool $full = false): string
  {
    if (strlen($this->descripcion) > $cantidad && !$full) {
      return substr($this->descripcion, 0, $cantidad) . '...';
    }
    return $this->descripcion;
  }

  /**
   * Devuelve la propiedad privada imagen del producto.
   * @return string
   * */
  public function getImagen(): string
  {
    return $this->imagen;
  }

  /**
   * Devuelve la propiedad privada fecha del producto.
   * @return string
   * */
  public function getFecha(): string
  {
    return $this->fecha;
  }

  /**
   * Devuelve un objeto Presentación
   * @return object
   * */
  public function getPresentacion(): object
  {
    return $this->presentacion_id;
  }

  /**
   * Devuelve la propiedad privada ingredientes del producto.
   * @return array
   * */
  public function getIngredientes(): array
  {
    return $this->ingredientes;
  }

  /**
   * Devuelve un string o un array de todos los sabores o de todos los ingredientes.
   * @param string $metodo
   * @param bool $toArray
   * @return mixed
   * */
  public function getData($metodo, $toArray = false): mixed
  {
    if (!$toArray) {
      return implode(", ", array_map(function ($opcion) {
        return $opcion->getNombre();
      }, $this->$metodo()));
    } else {
      return array_map(function ($opcion) {
        return $opcion->getId();
      }, $this->$metodo());
    }
  }
}
