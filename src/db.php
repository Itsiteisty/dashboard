<?php
require __DIR__ . '/../vendor/autoload.php';

$mongoUri = getenv('MONGO_URI'); // Pegando do Render

try {
    $client = new MongoDB\Client($mongoUri);
    $db = $client->selectDatabase('dashusers');
    $collection = $db->selectCollection('users');
} catch (Exception $e) {
    die("Erro na conexão com o MongoDB: " . $e->getMessage());
}
?>
