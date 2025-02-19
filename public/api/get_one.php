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

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(['message' => "Error: Item ID is missing!"]);
    exit;
}

$db = new Database();
$db = $db->connect();

$itemModel = new ItemModel($db);
$itemEntity = new ItemEntity();

if ($row = $itemModel->fetchOne($_GET['id'])) {

    echo json_encode($row);
} else {
    echo json_encode(array('message' => "No records found!"));
}
