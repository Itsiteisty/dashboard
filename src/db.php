<?php
require __DIR__ . '/../vendor/autoload.php';
use MongoDB\Client;

$mongoUri = getenv('MONGO_URI');
$mongoDbName = getenv('MONGO_DB_NAME');

if (!$mongoUri || !$mongoDbName) {
    die("Mongo URI or DB Name not set in environment variables.");
}

try {
    $client = new Client($mongoUri);
    $db = $client->$mongoDbName;
} catch (Exception $e) {
    die("Failed to connect to MongoDB: " . $e->getMessage());
}
