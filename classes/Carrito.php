<?php
class Carrito
{

    /**
     * Inserta una nueva compra y detalle compra
     * @return void
     */
    public function insert(array $compras): void
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO compras VALUES (null, ?, ?, ?)";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            $compras['usuario_id'],
            $compras['precio_total'],
            $compras['fecha']
        ]);
        $compra_id = $conexion->lastInsertId();

        $agregados = [];
        foreach ($this->getCarrito() as $llave => $valores) {
            $producto_id = $llave;
            $sabor = is_array($valores['sabor']) ? (new Sabor())->get_por_id($valores['sabor'][0])->getNombre() : $valores['sabor'];
            echo "<pre>";
            print_r($sabor);
            echo "</pre>";
            $precio = $valores['precio'];
            $cantidad = $valores['cantidad'];
            if (isset($agregados[$producto_id])) {
                $agregados[$producto_id]['cantidad'] += $cantidad;
            } else {
                $agregados[$producto_id] = [
                    'precio' => $precio,
                    'cantidad' => $cantidad,
                    'sabor' => $sabor
                ];
            }
        }

        foreach ($agregados as $producto_id => $datos) {
            $query = "INSERT INTO detalle_compra VALUES (null, :compra_id, :producto_id, :precio, :cantidad, :sabor)";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([
                "compra_id" => $compra_id,
                "producto_id" => $producto_id,
                "precio" => $datos['precio'],
                "cantidad" => $datos['cantidad'],
                "sabor" => $datos['sabor']
            ]);
        }
    }

    /**
     * Devuelve el carrito
     * @return array
     */
    public function getCarrito(): array
    {
        if (!empty($_SESSION['carrito'])) {
            return $_SESSION['carrito'];
        }
        return [];
    }

    /**
     * Agrega un producto al carrito
     * @param int $productoId
     * @param int $cantidad
     * @return void
     */
    public function agregarProducto(int $id): void
    {
        $data = (new Producto())->filtradoId($id);
        if ($data) {
            $_SESSION['carrito'][$id] = [
                'id' => $id,
                'titulo' => $data->opcionesProductos(),
                'precio' => $data->getPrecio(),
                'imagen' => $data->getImagen(),
                'sabor' => $data->getData('getSabores', true),
                'cantidad' => 1
            ];
        }
    }

    /**
     * Elimina un producto del carrito
     * @param int $productoId
     * @return void
     */
    public function eliminarProducto(int $productoId): void
    {
        if (isset($_SESSION['carrito'][$productoId])) {
            unset($_SESSION['carrito'][$productoId]);
        }
    }

    /**
     * Vacia el carrito
     * @return void
     */
    public function vaciarCarrito(): void
    {
        $_SESSION['carrito'] = [];
    }

    /**
     * Actualiza la cantidad de cada producto
     * @param array $cantidades
     * @return void
     */
    public function actualizarCantidades(array $cantidades): void
    {
        foreach ($cantidades as $llave => $valor) {
            if (isset($_SESSION['carrito'][$llave])) {
                $_SESSION['carrito'][$llave]['cantidad'] = $valor;
            }
        }
    }

    /**
     * Actualiza el sabor de cada producto
     * @param array $sabores
     * @return void
     */
    public function actualizarSabores(array $sabores): void
    {
        foreach ($sabores as $llave => $valor) {
            if (isset($_SESSION['carrito'][$llave])) {
                $_SESSION['carrito'][$llave]['sabor'] = $valor;
            }
        }
    }

    /**
     * Devuelve el precio total
     * @return string
     */
    public function getTotal(): string
    {
        $total = 0;
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }
        }
        return $total;
    }
}
