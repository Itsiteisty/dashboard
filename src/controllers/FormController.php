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
        try {
            $result = $this->collection->insertOne($data);
            if ($result->getInsertedId()) {
                return ['success' => true, 'message' => 'Application submitted successfully.'];
            } else {
                return ['success' => false, 'message' => 'Failed to submit application.'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
