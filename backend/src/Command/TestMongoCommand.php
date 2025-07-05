<?php 

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use MongoDB\Client;
use Symfony\Component\Dotenv\Dotenv;


#[AsCommand(
    name: 'app:test-mongo',
    description: 'Test de la connexion à MongoDB et insertion d’un document.'
)]
class TestMongoCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Test de connexion à MongoDB en cours...');

        // Charger les variables d’environnement
        (new Dotenv())->bootEnv(dirname(__DIR__, 2) . '/.env.local');

        // Récupérer les variables d'environnement
        $mongoUrl = getenv('MONGODB_URL') ?: 'mongodb://localhost:27017/';
        $mongoDatabase = getenv('MONGODB_DATABASE') ?: 'arcadiazoo_mongo_db';

        try {
            // Connexion à MongoDB
            $client = new Client($mongoUrl);
            $database = $client->selectDatabase($mongoDatabase);
            $collection = $database->selectCollection('test_collection');
            
            // Ajout d'un document
            $result = $collection->insertOne([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'created_at' => new \MongoDB\BSON\UTCDateTime(),
            ]);

            $output->writeln('✅ Connexion réussie à MongoDB !');
            $output->writeln('Document inséré avec succès : ' . $result->getInsertedId());

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $output->writeln('❌ Erreur de connexion à MongoDB : ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}




