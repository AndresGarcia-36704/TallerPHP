<?php
require __DIR__ . '/../vendor/autoload.php';
session_start();

use App\Controllers\VentaController;
use App\Controllers\EmpleadoController;
use App\Controllers\CalculadoraController;
use App\Models\Venta;
use App\Models\Empleado;

$ventasData = json_decode(file_get_contents(__DIR__ . '/../data/ventas.json'), true) ?? [];
$ventas = array_map(
    fn($v) => new Venta($v['id'], $v['cliente'], $v['producto'], $v['cantidad'], $v['precio'], $v['fecha']),
    $ventasData
);

$empleadosData = json_decode(file_get_contents(__DIR__ . '/../data/empleados.json'), true) ?? [];
$empleados = array_map(
    fn($e) => new Empleado($e['nombre'], $e['salario'], $e['departamento']),
    $empleadosData
);

$controllers = [
    'ventas'      => new VentaController($ventas),
    'empleados'   => new EmpleadoController($empleados),
    'calculadora' => new CalculadoraController(),
];

$page   = $_GET['page'] ?? 'ventas';   // Página actual
$action = $_GET['action'] ?? null;     // Acción (PDF, Mail, etc.)

// Descargar PDF
if ($action === 'descargar_resumen' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controllers[$page]->descargarPdfResumen();
    exit;
}

// Enviar resumen por correo
if ($action === 'enviar_resumen' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controllers[$page]->enviarResumenPorCorreo();
    exit;
}

if (isset($controllers[$page])) {
    $controllers[$page]->index();
} else {
    http_response_code(404);
    echo "<h1>404 - Página no encontrada</h1>";
}
