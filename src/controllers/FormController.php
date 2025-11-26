<?php
// Caminho esperado para o db.php
require_once __DIR__ . '/../database/db.php';

// Verifica se o arquivo existe antes de incluir
if (!file_exists($dbPath)) {
    die("Erro: arquivo db.php não encontrado em $dbPath");
}

// Inclui o arquivo
require_once $dbPath;

use MongoDB\Driver\Exception\Exception;

class FormController
{
    protected $collection;

    public function __construct()
    {
        global $db;
        if (!$db) {
            throw new Exception("MongoDB Database não definido.");
        }
        $this->collection = $db->selectCollection('staff_form');
    }

    public function submit(array $data): array
    {
        if (empty($data['name']) || empty($data['discord']) || empty($data['age'])) {
            return ['success' => false, 'message' => 'Name, Discord, and Age are required.'];
        }

        $data['submitted_at'] = time();
        $data['ip'] = $_SERVER['REMOTE_ADDR'] ?? 'IP não encontrado';

        try {
            $result = $this->collection->insertOne($data);

            if ($result->getInsertedId()) {
                error_log("Nova submissão de formulário:");
                error_log("ID: " . (string)$result->getInsertedId());
                error_log("Nome: " . $data['name']);
                error_log("Discord: " . $data['discord']);
                error_log("IP: " . $data['ip']);

                return ['success' => true, 'message' => 'Application submitted successfully.'];
            } else {
                return ['success' => false, 'message' => 'Falha ao inserir no MongoDB.'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'MongoDB Error: ' . $e->getMessage()];
        }
    }
}

