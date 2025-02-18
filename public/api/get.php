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

$db = (new Database())->connect();
$itemModel = new ItemModel($db);

$resultSet = $itemModel->fetchAll();

if (count($resultSet) > 0) {

    $items = [];

    foreach ($resultSet as $row) {
        array_push($items, (new ItemEntity())->hydrate($row));
    }

    echo json_encode($items);
} else {
    echo json_encode(array('message' => "No records found!"));
}
