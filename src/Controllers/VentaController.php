<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Venta;
use App\Utils\PDFGenerator;
use App\Utils\EmailSender;

class VentaController
{
    public function __construct(private array $ventas) {}

    public function index(): void
    {

        $total       = Venta::totalVentas($this->ventas);
        $clienteTop  = Venta::clienteTop($this->ventas);
        $productoTop = Venta::productoTop($this->ventas);

        $view = __DIR__ . '/../../views/ventas/index.php';
        include __DIR__ . '/../../views/layout.php';
    }

    public function generarHtmlResumen(): string
    {
        $ventas      = $this->ventas;
        $total       = Venta::totalVentas($ventas);
        $clienteTop  = Venta::clienteTop($ventas);
        $productoTop = Venta::productoTop($ventas);

        ob_start();
        include __DIR__ . '/../../views/ventas/partial_resumenV.php';
        return ob_get_clean();
    }

    public function enviarResumenPorCorreo(): void
    {
        $emailDestino = trim($_POST['email'] ?? '');

        // Validar email
        if (!filter_var($emailDestino, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash'] = "Email inválido.";
            header("Location: ?page=ventas");
            exit;
        }

        // Generar PDF
        $html   = $this->generarHtmlResumen();
        $pdfBin = PDFGenerator::generarPdfBinario($html);

        // Configurar envío
        $dsn    = $_ENV['MAIL_DSN'] ?? ($_SERVER['MAIL_DSN'] ?? 'smtp://user:pass@smtp.mailtrap.io:2525');
        $sender = new EmailSender($dsn, 'no-reply@local.test');

        try {
            $sender->enviarHtmlConAdjunto(
                $emailDestino,
                'Resumen de ventas',
                '<p>Adjunto encontrarás el resumen de ventas.</p>',
                $pdfBin,
                'resumen_ventas.pdf'
            );
            $_SESSION['flash'] = "Resumen enviado a {$emailDestino}.";
        } catch (\Throwable $e) {
            $_SESSION['flash'] = "Error enviando el correo: " . $e->getMessage();
        }

        header("Location: ?page=ventas");
        exit;
    }

    public function descargarPdfResumen(): void
    {
        $html = $this->generarHtmlResumen();
        PDFGenerator::forzarDescarga($html, 'resumen_ventas.pdf');
    }
}
