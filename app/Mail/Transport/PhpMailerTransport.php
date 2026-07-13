<?php

namespace App\Mail\Transport;

use PHPMailer\PHPMailer\SMTP;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;

class PhpMailerTransport extends AbstractTransport
{
    public function __construct(private array $config)
    {
        parent::__construct();
    }

    public function __toString(): string
    {
        return 'phpmailer';
    }

    protected function doSend(SentMessage $message): void
    {
        $smtp = new SMTP();
        $smtp->setDebugLevel(SMTP::DEBUG_OFF);

        $host = $this->config['host'] ?? '127.0.0.1';
        $port = (int) ($this->config['port'] ?? 25);
        $timeout = (int) ($this->config['timeout'] ?? 30);
        $encryption = $this->config['encryption'] ?? null;

        if ($encryption === 'ssl' && ! str_starts_with($host, 'ssl://')) {
            $host = 'ssl://' . $host;
        }

        if (! $smtp->connect($host, $port, $timeout)) {
            throw $this->exception($smtp, 'No se pudo conectar al servidor SMTP con PHPMailer.');
        }

        try {
            $localDomain = $this->config['local_domain'] ?? 'localhost';

            if (! $smtp->hello($localDomain)) {
                throw $this->exception($smtp, 'El servidor SMTP rechazó el saludo EHLO/HELO.');
            }

            if ($encryption === 'tls') {
                if (! $smtp->startTLS() || ! $smtp->hello($localDomain)) {
                    throw $this->exception($smtp, 'No se pudo iniciar TLS con PHPMailer.');
                }
            }

            $username = $this->config['username'] ?? null;
            $password = $this->config['password'] ?? null;

            if ($username !== null && $username !== '') {
                if (! $smtp->authenticate($username, (string) $password)) {
                    throw $this->exception($smtp, 'No se pudo autenticar con el servidor SMTP.');
                }
            }

            $envelope = $message->getEnvelope();

            if (! $smtp->mail($envelope->getSender()->getAddress())) {
                throw $this->exception($smtp, 'El servidor SMTP rechazó el remitente.');
            }

            foreach ($envelope->getRecipients() as $recipient) {
                if (! $smtp->recipient($recipient->getAddress())) {
                    throw $this->exception($smtp, 'El servidor SMTP rechazó un destinatario.');
                }
            }

            if (! $smtp->data($message->toString())) {
                throw $this->exception($smtp, 'El servidor SMTP rechazó el contenido del mensaje.');
            }
        } finally {
            $smtp->quit();
            $smtp->close();
        }
    }

    private function exception(SMTP $smtp, string $fallback): TransportException
    {
        $error = $smtp->getError();
        $message = trim((string) ($error['error'] ?? ''));
        $detail = trim((string) ($error['detail'] ?? ''));

        if ($message !== '' && $detail !== '') {
            return new TransportException("{$message}: {$detail}");
        }

        return new TransportException($message !== '' ? $message : $fallback);
    }
}
