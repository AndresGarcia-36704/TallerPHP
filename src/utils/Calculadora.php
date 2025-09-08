<?php
declare(strict_types=1);
namespace App\Utils;

class Calculadora {
    public static function interesCompuesto(float $capital,float $tasa,int $plazo): float {
        return $capital * pow((1+$tasa/100),$plazo);
    }

    public static function salarioNeto(float $bruto): float {
        $salud=$bruto*0.04;
        $pension=$bruto*0.04;
        return $bruto-($salud+$pension);
    }
}
