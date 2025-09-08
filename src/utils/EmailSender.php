<?php
declare(strict_types=1);

namespace App\Utils;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\Multipart\AlternativePart;

class EmailSender
{
    private Mailer $mailer;
    private string $from;

    public function __construct(string $dsn, string $from = 'no-reply@local.test')
    {
        $transport = Transport::fromDsn($dsn);
        $this->mailer = new Mailer($transport);
        $this->from = $from;
    }

    public function enviarHtmlConAdjunto(string $to, string $subject, string $html, ?string $attachmentBytes = null, string $attachmentName = 'adjunto.pdf'): void
    {
        $email = (new Email())
            ->from($this->from)
            ->to($to)
            ->subject($subject)
            ->html($html);

        if ($attachmentBytes !== null) {
            // crea parte con contenido binario
            $email->attach($attachmentBytes, $attachmentName, 'application/pdf');
        }

        $this->mailer->send($email);
    }
}
