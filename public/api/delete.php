<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include_once '../../src/api/config/Database.php';
include_once '../../src/api/models/ItemModel.php';
include_once '../../src/api/models/ItemEntity.php';

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
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

$data = json_decode(file_get_contents("php://input"));

if ($itemModel->delete($data->id)) {
	echo json_encode(array('message' => 'Item deleted'));
} else {
	echo json_encode(array('message' => 'Item Not deleted, try again!'));
}
