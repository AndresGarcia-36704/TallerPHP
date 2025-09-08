<?php
declare(strict_types=1);

$Ventas = [
    ['id' => 1, 'cliente' => 'Ana', 'Producto' => 'Laptop', 'cantidad' => 1, 'precio' => 1_200_000, 'fecha' => '2023-01-15'],
    ['id' => 2, 'cliente' => 'Luis', 'Producto' => 'Smartphone', 'cantidad' => 2, 'precio' => 800_000, 'fecha' => '2023-01-20'],
    ['id' => 3, 'cliente' => 'Marta', 'Producto' => 'Tablet', 'cantidad' => 1, 'precio' => 1_000_000, 'fecha' => '2023-02-10'],
    ['id' => 4, 'cliente' => 'Carlos', 'Producto' => 'Laptop', 'cantidad' => 2, 'precio' => 1_200_000, 'fecha' => '2023-02-15'],
    ['id' => 5, 'cliente' => 'Sofía', 'Producto' => 'Smartphone', 'cantidad' => 3, 'precio' => 800_000, 'fecha' => '2023-03-05'],
    ['id' => 6, 'cliente' => 'Javier', 'Producto' => 'Tablet', 'cantidad' => 4, 'precio' => 1_000_000, 'fecha' => '2023-03-10'],
    ['id' => 7, 'cliente' => 'Lucía', 'Producto' => 'Tablet', 'cantidad' => 1, 'precio' => 1_000_000, 'fecha' => '2023-04-01'],
    ['id' => 8, 'cliente' => 'Miguel', 'Producto' => 'Laptop', 'cantidad' => 2, 'precio' => 1_200_000, 'fecha' => '2023-04-05'],
    ['id' => 9, 'cliente' => 'Elena', 'Producto' => 'Laptop', 'cantidad' => 1, 'precio' => 1_200_000, 'fecha' => '2023-05-12'],
    ['id' => 10, 'cliente' => 'Diego', 'Producto' => 'Smartphone', 'cantidad'=> 1, 'precio'=> 800_000, 'fecha'=> '2023-05-20'],    
]; 

function TotalVentas(array $ventas): int {
    return count($ventas);
}

function ClienteTop(array $ventas): array {
    $clientes = [];
    foreach ($ventas as $v) {
        $total = $v['cantidad'] * $v['precio'];
        $clientes[$v['cliente']] = ($clientes[$v['cliente']] ?? 0) + $total;
    }
    arsort($clientes); 
    $nombre = array_key_first($clientes);
    return ['cliente' => $nombre, 'total' => $clientes[$nombre]];
}

function ProductoTop(array $ventas): array {
    $productos = [];
    foreach ($ventas as $v) {
        $productos[$v['Producto']] = ($productos[$v['Producto']] ?? 0) + $v['cantidad'];
    }
    arsort($productos);
    $nombre = array_key_first($productos);
    return ['producto' => $nombre, 'total' => $productos[$nombre]];
}

function imprimirResultadosVentas(array $ventas): void {
    $totalVentas = TotalVentas($ventas);
    $topCliente = ClienteTop($ventas);
    $topProducto = ProductoTop($ventas);

    echo "<h2>Resultados de Ventas:</h2>";
    echo "<p><strong>Total de ventas realizadas:</strong> $totalVentas</p>";
    echo "<p><strong>Cliente que más gastó:</strong> {$topCliente['cliente']} (" . number_format($topCliente['total'], 0, ',', '.') . " COP)</p>";
    echo "<p><strong>Producto más vendido:</strong> {$topProducto['producto']} ({$topProducto['total']} unidades)</p>";
}

imprimirResultadosVentas($Ventas);
