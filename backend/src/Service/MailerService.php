<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private MailerInterface $mailer;
    private string $zooEmail;

    public function __construct(MailerInterface $mailer, string $zooEmail)
    {
        $this->mailer = $mailer;
        $this->zooEmail = $zooEmail;
    }

    public function sendEmail(string $to, string $subject, string $text): void
    {
        $email = (new \Symfony\Component\Mime\Email())
            ->from($this->zooEmail)
            ->to($to)
            ->subject($subject)
            ->text($text);

        $this->mailer->send($email);
    }
}
