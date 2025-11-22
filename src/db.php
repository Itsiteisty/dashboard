<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use MongoDB\Client;

// Carrega variáveis de ambiente
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Conexão com MongoDB
$client = new Client($_ENV['MONGO_URI']);
$collection = $client->{$_ENV['MONGO_DB']}->{$_ENV['MONGO_COLLECTION']};
