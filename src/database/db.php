<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use MongoDB\Client;
use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

try {
    $mongoURI = $_ENV['MONGO_URI'] ?? 'mongodb://localhost:27017';
    $dbName   = $_ENV['MONGO_DB'] ?? 'discord_server';

    $client = new Client($mongoURI);
    $db     = $client->selectDatabase($dbName);

} catch (Exception $e) {
    die("Error connecting to MongoDB: " . $e->getMessage());
}
