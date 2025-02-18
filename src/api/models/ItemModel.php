<?php

class ItemModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function fetchAll()
    {

        $stmt = $this->conn->prepare('SELECT * FROM item');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchOne(string $id)
    {

        $stmt = $this->conn->prepare('SELECT  * FROM item WHERE id = ?');
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function postData($itemEntity): bool
    {
        $stmt = $this->conn->prepare('
            INSERT INTO item (id, name, url, description, technology, docker, port) VALUES (:id, :name, :url, :description, :technology, :docker, :port)
        ');

        $stmt->bindParam(':id', $itemEntity->id);
        $stmt->bindParam(':name', $itemEntity->name);
        $stmt->bindParam(':url', $itemEntity->url);
        $stmt->bindParam(':description', $itemEntity->description);
        $stmt->bindParam(':technology', $itemEntity->technology);
        $stmt->bindParam(':docker', $itemEntity->docker);
        $stmt->bindParam(':port', $itemEntity->port);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function putData($itemEntity): bool
    {

        $stmt = $this->conn->prepare('UPDATE item SET name = :name, url = :url, description = :description, technology = :technology, docker = :docker, port = :port WHERE id = :id');

        $stmt->bindParam(':id', $itemEntity->id);
        $stmt->bindParam(':name', $itemEntity->name);
        $stmt->bindParam(':url', $itemEntity->url);
        $stmt->bindParam(':description', $itemEntity->description);
        $stmt->bindParam(':technology', $itemEntity->technology);
        $stmt->bindParam(':docker', $itemEntity->docker);
        $stmt->bindParam(':port', $itemEntity->port);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete(string $id): bool
    {

        $stmt = $this->conn->prepare('DELETE FROM item WHERE id = :id');
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
