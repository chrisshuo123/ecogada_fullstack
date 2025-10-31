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

    public function getUserById($idUser) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE idUser=:idUser');
        $this->db->bind('idUser', $idUser);
        return $this->db->single();
    }

    public function tambahDataUser($data) {
        $query = "INSERT INTO user
            VALUES
                ('', :tglRegistrasi, :namaDepan, :namaBelakang, :email, :username, :password)";
        $this->db->query($query);
        $this->db->bind(':tglRegistrasi', $data['tglRegistrasi']);
        $this->db->bind(':namaDepan', $data['namaDepan']);
        $this->db->bind(':namaBelakang', $data['namaBelakang']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));

        $this->db->execute();

        return $this->db->rowCount();
    }

    // Check if email exists (optional)
    public function cekEmailExists($email) {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $this->db->query($query);
        $this->db->bind(':email', $email);
        $result = $this->db->single();
        return $result['count'] > 0;
    }
}