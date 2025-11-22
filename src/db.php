<?php
require_once __DIR__ . '/../vendor/autoload.php';

$mongoUri = getenv('MONGO_URI');
$mongoClient = new MongoDB\Client($mongoUri);
$database = $mongoClient->selectDatabase('dashusers');
$collection = $database->selectCollection('users');
