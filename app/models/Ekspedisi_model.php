<?php

class Ekspedisi_model {
    private $tableEkspedisi = 'ekspedisi';
    private $tableJenisEkspedisi = 'jenis_ekspedisi';
    private $tableLayananEkspedisi = 'layanan_ekspedisi';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getNamaEkspedisi($idEkspedisi) {
        $query = 'SELECT namaEkspedisi FROM ekspedisi WHERE idEkspedisi = :idEkspedisi';
        $this->db->query($query);
        $this->db->bind(":idEkspedisi", $idEkspedisi);
        $result = $this->db->single();

        if($result && isset($result['namaEkspedisi'])) {
            return $result['namaEkspedisi']; // Return string nama saja
        }
        return "Ekspedisi tidak ditemukan di method getNamaEkspedisi";
    }

    // Untuk menangkap Image Logo Ekspedisi bagi hal. views/ekspedisi/index
    public function getEkspedisiById($idEkspedisi) {
        error_log("=== GET EKSPEDISI BY ID ===");
        error_log("ID: " . $idEkspedisi);

        $query = 'SELECT idEkspedisi, namaEkspedisi, HEX(fotoEkspedisi) as foto_hex FROM ekspedisi WHERE idEkspedisi = :idEkspedisi';
        $this->db->query($query);
        $this->db->bind(':idEkspedisi', $idEkspedisi);
        
        $result = $this->db->single();

        // DEBUG CRITICAL
        // error_log("Result type: " . gettype($result));
        // error_log("Result keys: " . (is_array($result) ? implode(', ', array_keys($result)) : 'NOT ARRAY'));
        // error_log("fotoEkspedisi exists: " . (isset($result['fotoEkspedisi']) ? 'YES' : 'NO'));
        // error_log("fotoEkspedisi type: " . gettype($result['fotoEkspedisi']));

        // if(isset($result['fotoEkspedisi'])) {
        //     error_log("fotoEkspedisi length: " . strlen($result['fotoEkspedisi']));
        //     error_log("fotoEkspedisi first 10 chars: " . bin2hex(substr($result['fotoEkspedisi'], 0, 10)));
        // }
        // ==== KETEMU: fotoEkspedisi pada 'fotoEkspedisi exists' mengreturn NO, karena PHP tidak bisa membaca file BLOB sehingga dianggap Null.

        if($result && !empty($result['foto_hex'])) {
            error_log("HEX data found, length: " . strlen($result['foto_hex']));
            // Convert HEX back to binary
            $result['fotoEkspedisi'] = hex2bin($result['foto_hex']);
            unset($result['foto_hex']);
        } else {
            error_log("No HEX data found");
            $result['fotoEkspedisi'] = null;
        }
        
        return $result;
    }

    public function getAllEkspedisiGrouped() { // Karna ini dari DB m:n
        $query = '
            SELECT
                L.idLayananEkspedisi,
                E.idEkspedisi,
                E.fotoEkspedisi,
                E.namaEkspedisi,
                J.jenisEkspedisi,
                J.deskripsi
            FROM
                layanan_ekspedisi as L
            LEFT JOIN
                ekspedisi as E ON L.idEkspedisi_fkLayananEkspedisi = E.idEkspedisi
            LEFT JOIN
                jenis_ekspedisi as J ON L.idJenisEkspedisi_fkLayananEkspedisi = J.idJenisEkspedisi;
            ';

        $this->db->query($query);

        try {
            $rawData = $this->db->resultSet();
        } catch (Exception $e) {
            // Log error atau return array kosong
            error_log("Database error: " . $e->getMessage());
            return [];
        }

        // Perbaikan: Gunakan idEkspedisi sebagai Key secara konsisten
        // GROUPING DI MODEL - Struktur yang benar
        // Group data by nama ekspedisi
        $groupedData = [];
        foreach($rawData as $item) {
            $idEkspedisi = $item['idEkspedisi'];

            if(!isset($groupedData[$idEkspedisi])) {
                $groupedData[$idEkspedisi] = [
                    'idEkspedisi' => $idEkspedisi,
                    'idEkspedisi' => $item['idEkspedisi'],
                    'namaEkspedisi' => $item['namaEkspedisi'], // Simpan id ekspedisi disini
                    'fotoEkspedisi' => $item['fotoEkspedisi'], // Simpan Blog data langsung
                    'jenisLayanan' => [] // Array untuk jenis - jenis layanan
                ];
            }
            if(!in_array($item['jenisEkspedisi'], $groupedData[$idEkspedisi]['jenisLayanan'])) // Kenapa tidak bisa pakai && melainkan harus koma ','?
            $groupedData[$idEkspedisi]['jenisLayanan'][] = $item['jenisEkspedisi'];
        }

        return $groupedData;
    }

    public function getJenisEkspedisi_By_IdEkspedisi($idEkspedisi) {
        $query = 'SELECT J.jenisEkspedisi, J.deskripsi
            FROM layanan_ekspedisi L
            JOIN jenis_ekspedisi J ON L.idJenisEkspedisi_fkLayananEkspedisi = J.idJenisEkspedisi
            WHERE L.idEkspedisi_fkLayananEkspedisi = :idEkspedisi
        ';

        $this->db->query($query);
        $this->db->bind(":idEkspedisi", $idEkspedisi);
        $result = $this->db->resultSet();

        // Debug hasil query
        error_log("Query result for idEkspedisi $idEkspedisi: " . print_r($result, true));
        
        return $result;

        // if($result && isset($result['idEkspedisi'])) {
        //     return $result['idEkspedisi']; // Return string nama saja
        // }
        // return "idEkspedisi tidak ditemukan di method getJenisEkspedisi_By_IdEkspedisi";
    }

    // Sertakan method checkLayananEkspedisiTable memastikan idEkspedisi terbaca di di tabel layanan_ekspedisi:
    // Bagian ini ditambahkan setelah mengdebug lewat method debugTableStructure dan checkEkspedisiTable
    public function checkLayananEkspedisiTable($idEkspedisi) {
        $query = "SELECT * FROM layanan_ekspedisi WHERE idEkspedisi_fkLayananEkspedisi = :idEkspedisi";
        $this->db->query($query);
        $this->db->bind(":idEkspedisi", $idEkspedisi);
        $layananData = $this->db->resultSet();
    
        // Debug buat mencari seluruh data layanan ekspedisi dari idEkspedisi:
        echo "<h4>Data di layanan ekspedisi: </h4>";
        echo "<pre>";
        print_r($layananData);
        echo "</pre>";

        // Cek tabel jenis_ekspedisi (tabel menampung seluruh layanan ekspedisi):
        $query2 = "SELECT * FROM jenis_ekspedisi";
        $this->db->query($query2);
        $jenisData = $this->db->resultSet();

        echo "<h4>Data di jenis_ekspedisi:</h4>";
        echo "<pre>";
        print_r($jenisData);
        echo "</pre>";
    }

    // models/Ekspedisi_model.php
    public function debugTableStructure() {
        $query = "DESCRIBE ekspedisi";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    // Cek Struktur Tabel Ekspedisi:
    public function checkEkspedisiTable() {
        $query = "SHOW COLUMNS FROM ekspedisi";
        $this->db->query($query);
        $columns = $this->db->resultSet();
        
        echo "<pre>Struktur Tabel Ekspedisi: ";
        print_r($columns);
        echo "</pre>";
        
        // Cek data yang ada
        $query2 = "SELECT * FROM ekspedisi LIMIT 5";
        $this->db->query($query2);
        $data = $this->db->resultSet();
        
        echo "<pre>Data Ekspedisi: ";
        print_r($data);
        echo "</pre>";
        exit;
    }
}