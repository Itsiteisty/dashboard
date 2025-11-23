<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;
use Dotenv\Dotenv;

// Carrega .env se existir
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

// Conecta ao MongoDB
$mongoURI = $_ENV['MONGO_URI'] ?? 'mongodb://localhost:27017';
$dbName   = $_ENV['MONGO_DB'] ?? 'discord_server';

try {
    $client = new Client($mongoURI);
    $db = $client->selectDatabase($dbName);
} catch (Exception $e) {
    die("Erro ao conectar no MongoDB: " . $e->getMessage());
}
