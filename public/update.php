<?php
require __DIR__ . '/../src/auth.php';
requireAdmin(); // Somente admins
require __DIR__ . '/../src/db.php';

use MongoDB\BSON\ObjectId;

// Pega parâmetros da URL
$id = $_GET['id'] ?? null;
$action = $_GET['action'] ?? null;

// Verifica se são válidos
if ($id && in_array($action, ['approve', 'reject'])) {
    // Atualiza status no MongoDB
    $collection->updateOne(
        ['_id' => new ObjectId($id)],
        ['$set' => ['status' => $action === 'approve' ? 'approved' : 'rejected']]
    );

    // Redireciona para dashboard com mensagem
    header('Location: dashboard.php?msg=Updated+successfully');
    exit; // MUITO IMPORTANTE para evitar warnings de header
}

// Se parâmetros inválidos
header('Location: dashboard.php?msg=Invalid+request');
exit;
