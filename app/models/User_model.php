<?php

class User_model {
    private $table = 'user';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllUser() {
        // stmt, dbh, prepare, execute, fetch sudah dilakukan di DB Wrapper core/Database.php
        // Jadi tinggal panggil saja dari Database class, lalu method query() didalamnya.
        // Didalam query(), jalankan parameternya pakai DL.
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet(); // Mengembalikan "semua" datanya
    }
}