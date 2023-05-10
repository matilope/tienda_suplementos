<?php

/**
 * Representa un producto con sus propiedades privadas y métodos públicos.
 */
class Producto
{
    private $id;
    private $nombre;
    private $marca;
    private $sabores;
    private $categoria;
    private $peso;
    private $precio;
    private $descripcion;
    private $imagenes;
    private $fecha;

    /**
     * Devuelve un array con todos los productos.
     * @param bool $mezclado En caso de le pase true mezcla el array, en caso de que no lo devuelve en el orden en el que esta en el JSON, por default es false.
     * @return Producto[]
     */
    public function productos(bool $mezclado = false): array
    {
        $productosJSON = json_decode(file_get_contents('./datos/productos.json'));
        $catalogo = [];
        foreach ($productosJSON as $value) {
            $producto = new self();
            $producto->id = $value->id;
            $producto->nombre = $value->nombre;
            $producto->marca = $value->marca;
            $producto->sabores = $value->sabores;
            $producto->categoria = $value->categoria;
            $producto->peso = $value->peso;
            $producto->precio = $value->precio;
            $producto->descripcion = $value->descripcion;
            $producto->imagenes = $value->imagenes;
            $producto->fecha = DateTime::createFromFormat('Y/m/d', $value->fecha);
            array_push($catalogo, $producto);
        }
        if ($mezclado) {
            shuffle($catalogo);
            return $catalogo;
        }
        return $catalogo;
    }

    /**
     * Devuelve un array de tipo Producto o un array vacio en caso de no encontrar coincidencias entre el parametro y cada nombre del array de productos.
     * @param int $nombre Recibe como parametro un string.
     * @return Producto[]
     * */
    public function filtradoBusqueda(string $nombre): array
    {
        $productos = $this->productos();
        $resultado = [];

        foreach ($productos as $producto) {
            if (str_contains($this->sacarAcentos(lcfirst($producto->nombre)), $this->sacarAcentos(lcfirst($nombre)))) {
                array_push($resultado, $producto);
            }
        }
        return $resultado;
    }

    /**
     * Devuelve un objeto Producto o null en caso de no encontrarlo.
     * @param int $id Recibe como parametro un integer.
     * @return mixed Devuelve un Producto o null.
     * */
    public function filtradoId(int $id): mixed
    {
        $productos = $this->productos();

        foreach ($productos as $producto) {
            if ($producto->id === $id) {
                return $producto;
            }
        }
        return null;
    }

    /**
     * Devuelve un array de tipo Producto conteniendo productos que tienen la misma categoria que se pasa por parametro.
     * @param string $categoria Recibe como parametro un string.
     * @return Producto[]
     * */
    public function filtradoCategoria(string $categoria): array
    {
        $productos = $this->productos(true);
        $resultado = [];

        foreach ($productos as $producto) {
            if ($producto->categoria === $categoria) {
                array_push($resultado, $producto);
            }
        }
        return $resultado;
    }

    /**
     * Devuelve un array de tipo Producto en un orden menor o mayor en cuanto al precio.
     * @param string $orden Recibe como parametro un string. Los valores que debe recibir el parametro es "menor" o otro valor distinto, en este ultimo caso, te lo va a ordenar de mayor a menor.
     * @return Producto[]
     * */
    public function filtradoPrecio(string $orden): array
    {
        $productos = $this->productos();
        usort($productos, function ($a, $b) {
            return $a->precio - $b->precio;
        });
        return $orden === "menor" ? $productos : array_reverse($productos);
    }

    /**
     * Devuelve un array de tipo Producto en un orden asc o desc en cuanto al nombre.
     * @param string $orden Recibe como parametro un string. Los valores que debe recibir el parametro es "asc" o otro valor distinto, en este ultimo caso, te lo va a ordenar de descendente a ascendente.
     * @return Producto[]
     * */
    public function filtradoNombre(string $orden): array
    {
        $productos = $this->productos();
        usort($productos, function ($a, $b) {
            if ($this->sacarAcentos($a->nombre) < $this->sacarAcentos($b->nombre)) {
                return -1;
            }
            if ($this->sacarAcentos($a->nombre) > $this->sacarAcentos($b->nombre)) {
                return 1;
            }
            return 0;
        });
        return $orden === "asc" ? $productos : array_reverse($productos);
    }

    /**
     * Devuelve un array de tipo Producto en un orden asc o desc en cuanto a la marca.
     * @param string $orden Recibe como parametro un string. Los valores que debe recibir el parametro es "asc" o otro valor distinto, en este ultimo caso, te lo va a ordenar de descendente a ascendente.
     * @return Producto[]
     * */
    public function filtradoMarca(string $orden): array
    {
        $productos = $this->productos();
        usort($productos, function ($a, $b) {
            if ($this->sacarAcentos($a->marca) < $this->sacarAcentos($b->marca)) {
                return -1;
            }
            if ($this->sacarAcentos($a->marca) > $this->sacarAcentos($b->marca)) {
                return 1;
            }
            return 0;
        });
        return $orden === "asc" ? $productos : array_reverse($productos);
    }

    /**
     * Devuelve un array el cual cada posición va a tener un string con el nombre, la marca y el peso del producto.
     * @param array $productos Recibe como parametro un array.
     * @return array
     * */
    public function opcionesProductos(array $productos): array
    {
        $opciones = [];

        foreach ($productos as $producto) {
            array_push($opciones, $producto->getNombre() . " - " . $producto->getMarca() . " - " . $producto->getPeso());
        }
        return $opciones;
    }

    /**
     * Devuelve un int que seria el parseo de kilogramos a los gramos.
     * @param float $kg Recibe como parametro un float.
     * @return int
     * */
    public function kgToG(float $kg): int
    {
        return $kg * 1000;
    }

    /**
     * Devuelve un string sin acentos.
     * @param string $texto Recibe como parametro un string.
     * @return string
     * */
    public function sacarAcentos($texto): string
    {
        $acentos = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú');
        $sinAcentos = array('a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U');
        $resultado = str_replace($acentos, $sinAcentos, $texto);
        return $resultado;
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
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Devuelve la propiedad privada marca del producto.
     * @return string
     * */
    public function getMarca(): string
    {
        return $this->marca;
    }

    /**
     * Devuelve la propiedad privada sabores del producto.
     * @return string
     * */
    public function getSabores(): string
    {
        return implode(", ", $this->sabores) . ".";
    }

    /**
     * Devuelve la propiedad privada categoria del producto.
     * @return string
     * */
    public function getCategoria(): string
    {
        return ucfirst($this->categoria);
    }

    /**
     * Devuelve la propiedad privada peso del producto.
     * En caso de que el valor de la propiedad sea menor a 1 se usa un método para pasarlo a gramos.
     * @return string
     * */
    public function getPeso(): string
    {
        if ($this->peso < 1) {
            return $this->kgToG($this->peso) . "g";
        }
        return $this->peso . "kg";
    }

    /**
     * Devuelve la propiedad privada precio del producto.
     * @return string
     * */
    public function getPrecio(): string
    {
        return number_format($this->precio, 2, ",", ".");
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
     * Devuelve la propiedad privada imagenes del producto.
     * @return array
     * */
    public function getImagenes(): array
    {
        return $this->imagenes;
    }

    /**
     * Devuelve la propiedad privada fecha del producto.
     * @return DateTime
     * */
    public function getFecha(): DateTime
    {
        return $this->fecha;
    }
}
