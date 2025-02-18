<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include_once '../../src/api/config/Database.php';
include_once '../../src/api/models/ItemModel.php';
include_once '../../src/api/models/ItemEntity.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode(['message' => "Error: incorrect Method!"]);
  exit;
}

$db = new Database();
$db = $db->connect();

$itemModel = new ItemModel($db);

$data = json_decode(file_get_contents("php://input"));

$itemEntity = (new ItemEntity)->hydrate((array) $data);

if ($itemModel->postData($itemEntity)) {

  echo json_encode(['message' => 'Item added']);
} else {

  echo json_encode(['message' => 'Item Not added, try again!']);
}
