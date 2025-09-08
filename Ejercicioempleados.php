<?php
declare(strict_types=1); // los parámetros y valores de retorno deben coincidir exactamente con los tipos declarados

$empleados = [
    ['nombre' => 'Ana', 'salario' => 3_000_000, 'departamento' => 'Ventas'],
    ['nombre' => 'Luis', 'salario' => 3_200_000, 'departamento' => 'Marketing'],
    ['nombre' => 'Marta', 'salario' => 2_400_000, 'departamento' => 'Ventas'],
    ['nombre' => 'Carlos', 'salario' => 4_000_000, 'departamento' => 'TI'],
    ['nombre' => 'Sofía', 'salario' => 2_200_000, 'departamento' => 'Marketing'],
    ['nombre' => 'Javier', 'salario' => 3_500_000, 'departamento' => 'TI'],
    ['nombre' => 'Lucía', 'salario' => 2_500_000, 'departamento' => 'Ventas'],
    ['nombre' => 'Miguel', 'salario' => 1_900_000, 'departamento' => 'Marketing'],
    ['nombre' => 'Elena', 'salario' => 3_300_000, 'departamento' => 'TI'],
    ['nombre' => 'Diego', 'salario' => 2_400_000, 'departamento' => 'Ventas'],    
];

function PromedioDepartamento(array $empleados): array {
    $contadorDepartamentos = [];
    foreach ($empleados as $e) {
        $depto = $e['departamento'];
        $salario = (float) $e['salario'];
        if (!isset($contadorDepartamentos[$depto])) {
            $contadorDepartamentos[$depto] = ['total' => 0.0, 'n' => 0];
        }
        $contadorDepartamentos[$depto]['total'] += $salario;
        $contadorDepartamentos[$depto]['n']++;
    }

    $promedios = [];
    foreach ($contadorDepartamentos as $depto => $a) {
        if ($a['n'] > 0) {
            $promedios[$depto] = $a['total'] / $a['n'];
        }        
    }
    return $promedios;
}

function MayorPromedioDepartamento(array $promedios): array {
    $Maxdepto = null;
    $MaxValor = PHP_FLOAT_MIN; 
    
    foreach ($promedios as $depto => $prom) {
        if ($prom > $MaxValor) {
            $MaxValor = $prom;
            $Maxdepto = $depto;
        }
    }
    return ['departamento' => $Maxdepto, 'promedio' => $MaxValor];
}

function empleadosSobrePromedio(array $empleados, array $promedio): array {
    $resultado = [];
    foreach ($empleados as $e) {
        $depto = $e['departamento'];
        if ($e['salario'] > $promedio[$depto]) {
            $resultado[] = $e;
        }
    }
    return $resultado;
}

function imprimirResultados(array $empleados): void {
    $promedios = PromedioDepartamento($empleados);
    $mayorPromedio = MayorPromedioDepartamento($promedios);
    $empleadosSobrePromedio = empleadosSobrePromedio($empleados, $promedios);

    echo "<h2>Promedio por departamento:</h2><ul>";
    foreach ($promedios as $depto => $prom) {
        echo "<li><strong>$depto:</strong> " . number_format($prom, 0, ',', '.') . " COP</li>";
    }
    echo "</ul>";

    if ($mayorPromedio['departamento'] !== null) {
        echo "<h3>Departamento con mayor salario promedio:</h3>";
        echo "<p><strong>{$mayorPromedio['departamento']}</strong> (" . number_format((float)$mayorPromedio['promedio'], 0, ',', '.') . " COP)</p>";
    }

    echo "<h3>Empleados sobre el promedio de su departamento:</h3>";
    if (empty($empleadosSobrePromedio)) {
        echo "<p>- (ninguno)</p>";
    } else {
        echo "<ul>";
        foreach ($empleadosSobrePromedio as $e) {
            echo "<li><strong>{$e['nombre']}</strong> ({$e['departamento']}) — " . number_format((float)$e['salario'], 0, ',', '.') . " COP</li>";
        }
        echo "</ul>";
    }
}

imprimirResultados($empleados);