<?php
require __DIR__ . '/../src/auth.php';
requireAdmin(); // Somente admins podem acessar
require __DIR__ . '/../src/db.php'; // Conexão com MongoDB

use MongoDB\BSON\ObjectId;

// Pega parâmetros da URL
$id = $_GET['id'] ?? null;
$action = $_GET['action'] ?? null;

// Valida parâmetros
if (!$id || !in_array($action, ['approve', 'reject'])) {
    die("Invalid request.");
}

// Tenta converter o ID para ObjectId
try {
    $objectId = new ObjectId($id);
} catch (Exception $e) {
    die("Invalid ID format.");
}

// Atualiza status no MongoDB
$result = $collection->updateOne(
    ['_id' => $objectId],
    ['$set' => ['status' => $action]]
);

if ($result->getModifiedCount() > 0) {
    header("Location: dashboard.php?msg=Updated successfully");
    exit;
} else {
    header("Location: dashboard.php?msg=Nothing updated");
    exit;
}
