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

    public function hapusDataUser($idUser) {
        $query = "DELETE FROM " . $this->table . " WHERE idUser = :idUser";
        $this->db->query($query);
        $this->db->bind(':idUser', $idUser);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahDataUser($data) {

        // DEBUG: Log semua data yang diterima
        error_log("=== DEBUG UBAH DATA USER MERCHANT ===");
        error_log("Data received:");
        error_log("nama depan: " . $data['namaDepan']);
        error_log("nama belakang: " . $data['namaBelakang']);
        error_log("email: " . $data['email']);
        error_log("username: " . $data['username']);
        error_log("password: " . $data['password']);
        error_log("id: " . $data['id']);
        error_log("idUser: " . $data['idUser']);

        $query = "UPDATE user SET
                    namaDepan = :namaDepan,
                    namaBelakang = :namaBelakang,
                    email = :email,
                    username = :username,
                    password = :password
                WHERE idUser = :id";

        // DEBUG: Log binding values
        error_log("Binding values:");
        error_log(":namaDepan = " . $data['namaDepan']);
        error_log(":namaBelakang = " . $data['namaBelakang']);
        error_log(":email = " . $data['email']);
        error_log(":username = " . $data['username']);
        error_log(":password = " . $data['password']);
        error_log(":id = " . $data['id']);
        error_log(":idUser = " . $data['idUser']);

        $this->db->query($query);
        $this->db->bind(':namaDepan', $data['namaDepan']);
        $this->db->bind(':namaBelakang', $data['namaBelakang']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':id', $data['id']);
    
        $this->db->execute();

        $rowCount = $this->db->rowCount();

        return $rowCount;
    }
}