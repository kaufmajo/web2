<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../src/api/config/Database.php';
include_once '../../src/api/models/ItemModel.php';
include_once '../../src/api/models/ItemEntity.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(['message' => "Error: incorrect Method!"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id) || null === $data->id) {
    echo json_encode(['message' => "Error: Item ID is missing!"]);
    exit;
}


$db = new Database();
$db = $db->connect();

$itemModel = new ItemModel($db);
$itemEntity = new ItemEntity();

if ($row = $itemModel->fetchOne($data->id)) {

    echo json_encode($row);
} else {
    echo json_encode(array('message' => "No records found!"));
}
