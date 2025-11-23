<?php
require_once __DIR__ . '/../database/db.php';

class FormController
{
    protected $collection;

    public function __construct()
    {
        global $db;
        $this->collection = $db->selectCollection('staff');
    }

    public function submit(array $data): array
    {
        if (empty($data['name']) || empty($data['discord']) || empty($data['age'])) {
            return ['success' => false, 'message' => 'Name, Discord, and Age are required.'];
        }

        try {
            $result = $this->collection->insertOne($data);
            return [
                'success' => (bool)$result->getInsertedId(),
                'message' => $result->getInsertedId() ? 'Application submitted successfully.' : 'Failed to submit application.'
            ];
        } catch (MongoDB\Driver\Exception\Exception $e) {
            return ['success' => false, 'message' => 'MongoDB Error: ' . $e->getMessage()];
        }
    }
}
