<?php
require __DIR__ . '/../src/db.php';
require __DIR__ . '/../src/auth.php';

header('Content-Type: application/json');

if(!isLoggedIn()) {
    echo json_encode(['success'=>false,'message'=>'Unauthorized']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? null;
$action = $data['action'] ?? null;

if(!$id || !in_array($action,['approve','reject'])){
    echo json_encode(['success'=>false,'message'=>'Invalid data']);
    exit;
}

$status = $action==='approve'?'approved':'rejected';

try{
    $db->staff_forms->updateOne(
        ['_id'=>new MongoDB\BSON\ObjectId($id)],
        ['$set'=>['status'=>$status]]
    );
    echo json_encode(['success'=>true]);
}catch(Exception $e){
    echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
}
