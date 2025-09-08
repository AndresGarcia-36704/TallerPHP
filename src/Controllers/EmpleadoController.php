<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Empleado;
use App\Utils\PDFGenerator;
use App\Utils\EmailSender;

class EmpleadoController
{
    public function __construct(private array $empleados) {}

    public function index(): void
    {

        $promedios     = Empleado::promedioPorDepartamento($this->empleados);
        $mayor         = Empleado::departamentoMayorPromedio($promedios);
        $sobrePromedio = Empleado::empleadosSobrePromedio($this->empleados, $promedios);

        $view = __DIR__ . '/../../views/empleados/index.php';
        include __DIR__ . '/../../views/layout.php';
    }

    public function generarHtmlResumen(): string
    {
        $empleados     = $this->empleados;
        $promedios     = Empleado::promedioPorDepartamento($empleados);
        $mayor         = Empleado::departamentoMayorPromedio($promedios);
        $sobrePromedio = Empleado::empleadosSobrePromedio($empleados, $promedios);

        ob_start();
        include __DIR__ . '/../../views/empleados/partial_resumenE.php';
        return ob_get_clean();
    }

    public function descargarPdfResumen(): void
    {
        $html = $this->generarHtmlResumen();
        PDFGenerator::forzarDescarga($html, 'resumen_empleados.pdf');
    }

    public function enviarResumenPorCorreo(): void
    {
        $emailDestino = trim($_POST['email'] ?? '');

        if (!filter_var($emailDestino, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash'] = "Email inválido.";
            header("Location: ?page=empleados");
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
                'Resumen de empleados',
                '<p>Adjunto encontrarás el resumen de empleados.</p>',
                $pdfBin,
                'resumen_empleados.pdf'
            );
            $_SESSION['flash'] = "Resumen enviado a {$emailDestino}.";
        } catch (\Throwable $e) {
            $_SESSION['flash'] = "Error enviando el correo: " . $e->getMessage();
        }

        header("Location: ?page=empleados");
        exit;
    }
}
