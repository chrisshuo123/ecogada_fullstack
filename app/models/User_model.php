<?php

class User_model {
    private $dbh;
    private $stmt;

    public function __construct() {
        // Data Source Handler
        $dsn = 'mysql:host=localhost:3307;dbname=ecogada';

        try {
            $this->dbh = new PDO($dsn, 'root', '');
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllUser() {
        $this->stmt = $this->dbh->prepare('SELECT * FROM user');
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}