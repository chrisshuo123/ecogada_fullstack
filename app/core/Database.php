<?php

class Database {
    private $host = DB_HOST;
    private $port = DB_PORT;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    // Add this property to track transaction value
    private $inTransaction = false;

    // Yg awal ada didalam model semua, pindahkan kesini saja
    public function __construct() {
        $dsn = 'mysql:host='.$this->host.";port=".$this->port.";dbname=".$this->db_name.";charset=utf8mb4";
    
        // Option: digunakan utk mengoptimasi DB kita, agar koneksi tetap persisten
        $option = [
            // Jangan stringify blob, dan gunakan native prepares
            PDO::ATTR_STRINGIFY_FETCHES => false, // ⚠️ PENTING: Jangan stringify BLOB
            PDO::ATTR_EMULATE_PREPARES => false, // ⚠️ PENTING: Gunakan native prepares
            // Yg General
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // This is important for Transactions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // ===== TRANSACTION METHODS =====

    /**
     * Begin a transaction
     */
    public function beginTransaction() {
        if(!$this->inTransaction) {
            $this->dbh->beginTransaction();
            $this->inTransaction = true;
        }
    }

    /**
     * Commit a transaction
     */
    public function commit() {
        if($this->inTransaction) {
            $this->dbh->commit();
            $this->inTransaction = false;
        }
    }

    /**
     * Rollback a transaction
     */
    public function rollBack() {
        if($this->inTransaction) {
            $this->dbh->rollBack();
            $this->inTransaction = false;
        }
    }

    /**
     * Check if currently in a transaction
     */
    public function inTransaction() {
        return $this->inTransaction;
    }

    /**
     * Execute a transaction with automatic commit/rollback
     * Usage: $db->transaction(function() use ($db) {
     *      $db->query("INSERT ...");
     *      $db->execute();
     * }); 
     */
    public function transaction(callable $callback) {
        try {
            $this->beginTransaction();
            $callback($this);
            $this->commit();
            return true;
        } catch(Exception $e) {
            $this->rollBack();
            throw $e;
        }
    }

    // ===== Query, Bind, Execute, Etc =====

    public function query($query) {  // querynya apapun nantinya
        // Yg isinya statement, diisi dgn handlernya (dbh), prepare, dan query
        $this->stmt = $this->dbh->prepare($query);
        // Disini querynya kita siapin, usernya maunya apa, apakah select, insert, update, delete.
    }

    // Selanjutnya kita jg perlu binding datanya, sp tau didalam querynya itu ada wherenya misalkan.  Lalu misalnya insert, insert itu valuesnya itu apa, kalau update itu ada set datanya apa, jadi istilahnya parameternya.
    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Lalu kita execute
    public function execute() {
        $this->stmt->execute();
    }

    // Lalu disini kita tentukan, setelah dieksekusi hasilnya kalian pengen banyak atau cuman 1 saja datanya?

    // Kalau mau banyak
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    } // Ini kalau mau banyak, kyk contoh "SELECT * FROM user"

    // Kalau mau cuman satu
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    } // Ini adalah wrappernya.

    // Diatas ini semua bisa kita pakai untuk tabel manapun nantinya

    // Untuk menghitung ada berapa baris yg baru berubah didalam tabelnya (misal: ada tambah, ada ngepush, ada ubah nantinya) itu ada angkanya
    public function rowCount() { // rowCount ini punya kita
        return $this->stmt->rowCount(); //rowCount ini punya PDO
    }

    /** ===============
     * Get the Last inserted ID
     * Alternative with error handling
     */
    public function lastInsertID() {
        try {
            return $this->dbh->lastInsertID();
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            error_log("lastInsertID error: ", $this->error);
            return false;
        }
    }

    // ===== ERROR HANDLING =====

    public function getError() {
        return $this->error;
    }

    public function debugDumpParams() {
        return $this->stmt->debugDumpParams();
    }
}