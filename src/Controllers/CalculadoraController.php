<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Utils\Calculadora;

class CalculadoraController 
{
    public function index(): void 
    {
        $interes     = null;
        $salarioNeto = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['capital'], $_POST['tasa'], $_POST['plazo'])) {
                $interes = Calculadora::interesCompuesto(
                    (float) $_POST['capital'],
                    (float) $_POST['tasa'],
                    (int) $_POST['plazo']
                );
            }

            if (isset($_POST['salario'])) {
                $salarioNeto = Calculadora::salarioNeto((float) $_POST['salario']);
            }
        }

        $view = __DIR__ . '/../../views/calculadora/index.php';
        include __DIR__ . '/../../views/layout.php';
    }
}
