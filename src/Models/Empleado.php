<?php
declare(strict_types=1);

namespace App\Models;

class Empleado
{
    public function __construct(
        public string $nombre,
        public float $salario,
        public string $departamento
    ) {}

    public static function promedioPorDepartamento(array $empleados): array
    {
        $deptos = [];

        foreach ($empleados as $e) {
            $d = $e->departamento;

            if (!isset($deptos[$d])) {
                $deptos[$d] = ['total' => 0, 'n' => 0];
            }

            $deptos[$d]['total'] += $e->salario;
            $deptos[$d]['n']++;
        }

        $prom = [];
        foreach ($deptos as $d => $v) {
            $prom[$d] = $v['total'] / $v['n'];
        }

        return $prom;
    }

    public static function empleadosSobrePromedio(array $empleados, array $promedios): array
    {
        return array_filter(
            $empleados,
            fn($e) => $e->salario > $promedios[$e->departamento]
        );
    }

    public static function departamentoMayorPromedio(array $promedios): array
    {
        arsort($promedios);

        $deptoTop = array_key_first($promedios);

        return [
            'departamento' => $deptoTop,
            'promedio'     => $promedios[$deptoTop]
        ];
    }
}
