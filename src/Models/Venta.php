<?php
declare(strict_types=1);

namespace App\Models;

class Venta
{
    public function __construct(
        public int $id,
        public string $cliente,
        public string $producto,
        public int $cantidad,
        public float $precio,
        public string $fecha
    ) {}

    public static function totalVentas(array $ventas): int
    {
        return count($ventas);
    }

    public static function clienteTop(array $ventas): array
    {
        $clientes = [];

        foreach ($ventas as $v) {
            $clientes[$v->cliente] = ($clientes[$v->cliente] ?? 0) + ($v->cantidad * $v->precio);
        }

        arsort($clientes);
        $nombre = array_key_first($clientes);

        return [
            'cliente' => $nombre,
            'total'   => $clientes[$nombre]
        ];
    }

    public static function productoTop(array $ventas): array
    {
        $productos = [];

        foreach ($ventas as $v) {
            $productos[$v->producto] = ($productos[$v->producto] ?? 0) + $v->cantidad;
        }

        arsort($productos);
        $nombre = array_key_first($productos);

        return [
            'producto' => $nombre,
            'total'    => $productos[$nombre]
        ];
    }
}
