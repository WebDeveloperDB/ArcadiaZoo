<?php

namespace App\Command;

use App\Service\MailerService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'mailer:test',
    description: 'Test de l\'envoi d\'un email',
)]
class MailerTestCommand extends Command
{
    private MailerService $mailerService;

    public function __construct(MailerService $mailerService)
    {
        parent::__construct();
        $this->mailerService = $mailerService;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('to', InputArgument::REQUIRED, 'Adresse e-mail du destinataire')
            ->addArgument('subject', InputArgument::OPTIONAL, 'Sujet de l\'e-mail', 'Test Mail')
            ->addArgument('content', InputArgument::OPTIONAL, 'Contenu de l\'e-mail', 'Ceci est un e-mail de test.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $to = $input->getArgument('to');
        $subject = $input->getArgument('subject');
        $content = $input->getArgument('content');

        try {
            $this->mailerService->sendTestEmail($to, $subject, $content);
            $output->writeln("E-mail envoyé avec succès à : $to");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $output->writeln("Erreur lors de l'envoi de l'e-mail : " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
