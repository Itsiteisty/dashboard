<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/auth.php';

$mongoUri = getenv('MONGO_URI') ?: 'mongodb://localhost:27017';
$client = new MongoDB\Client($mongoUri);

$db = $client->selectDatabase('dashusers');
$collection = $db->users;

var_dump($collection->countDocuments()); // teste rápido
