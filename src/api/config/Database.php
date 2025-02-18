<?php

class Database
{
    private $file = __DIR__ . "/../../../data/db.sqlite3";
    private $conn = NULL;

    public function connect()
    {
        try {
            $this->conn  = new PDO('sqlite:' . $this->file);
        } catch (PDOException $ex) {
            echo "Connection Error: " . $ex->getMessage();
        }

        return $this->conn;
    }
}