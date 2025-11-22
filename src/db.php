<?php
require __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

// Conexão com MongoDB usando variável de ambiente
$mongoUri = getenv('MONGO_URI');
$client = new Client($mongoUri);

// Seleciona o database e a collection
$collection = $client->dashusers->users;

// Não use echo, var_dump ou espaços antes do <?php
// Não feche o arquivo com ?>
