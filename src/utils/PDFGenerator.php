<?php
declare(strict_types=1);

namespace App\Utils;

use Dompdf\Dompdf;
use Dompdf\Options;

class PDFGenerator
{
    public static function generarPdfBinario(string $html, string $paper = 'A4', string $orientation = 'portrait'): string
    {
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();

        return $dompdf->output();
    }

    public static function forzarDescarga(string $html, string $nombreArchivo = 'reporte.pdf'): void
    {
        $pdf = self::generarPdfBinario($html);
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $nombreArchivo . '"');
        echo $pdf;
        exit;
    }
}
