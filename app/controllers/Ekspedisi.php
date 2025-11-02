<?php

class Ekspedisi extends Controller {
    public function index() {
        $data['judul'] = "Ekspedisi";
        // $data['ekspedisi'] = $this->model('Ekspedisi_model')->getAllEkspedisi();
        $data['ekspedisiGrouped'] = $this->model('Ekspedisi_model')->getAllEkspedisiGrouped();
        echo "Ekspedisi/index";

        $this->view('templates/header', $data);
        $this->view('ekspedisi/index', $data);
        $this->view('templates/footer');
    }

    public function detail($idEkspedisi) {
        // Pastikan ID valid
        // if (!is_numeric($idEkspedisi)) {
        //     header('Location: ' . BASEURL . '/ekspedisi');
        //     exit;
        // }

        $namaEkspedisi = $this->model('Ekspedisi_model')->getNamaEkspedisi($idEkspedisi);
        // Get semua layanan (jenis_ekspedisi) yang terkait dengan ekspedisi ini
        $data['ekspedisi'] = $this->model('Ekspedisi_model')->getJenisEkspedisi_By_IdEkspedisi($idEkspedisi);

        echo "Nama Ekspedisi yang didapat: ";
        var_dump($namaEkspedisi);
        echo "IdEkspedisi yang didapat: ";
        var_dump($idEkspedisi);
        exit;

        // Jika tidak ada data, redirect ke list:
        if (empty($data['ekspedisi'])) {
            header('location: ' . BASEURL . '/ekspedisi');
            exit;
        }

        $data['judul'] = "Detail " . $namaEkspedisi;
        // Judul pada halaman detail per ekspedisi (yg diatas untuk header):
        $data['judul_ekspedisi'] = $namaEkspedisi;
        

        $this->view('templates/header', $data);
        $this->view('ekspedisi/detail', $data);
        $this->view('templates/footer');
    }

    // Khusus testing halaman Ekspedisi/detail saja
    public function detail2() {
        $data['judul'] = "Halaman Detail Ekspedisi";
        $this->view('templates/header', $data);
        $this->view('ekspedisi/detail2');
        $this->view('templates/footer');
    }

    // controllers/Ekspedisi.php
    public function debug() {
        echo "<pre>";
        print_r($this->model('Ekspedisi_model')->debugTableStructure());
        echo "</pre>";
    }

    // Temporary debug method
    public function checkData($idEkspedisi = 2) {
        echo "<h1>Data check for ID: $idEkspedisi</h1>";

        // 1. Cek nama Ekspedisi
        $nama = $this->model('Ekspedisi_model')->getNamaEkspedisi($idEkspedisi);

        // 2. Cek data layanan
        $data = $this->model('Ekspedisi_model')->getJenisEkspedisi_By_IdEkspedisi($idEkspedisi);
        echo "<h3>Data layanan:</h3>";
        echo "<pre>";
        print_r($data);
        echo "</pre>";

        // 3. Cek apakah ada di tabel layanan_ekspedisi
        echo "<h3>Check layanan_ekspedisi table:</h3>";
        $this->model('Ekspedisi_model')->checkLayananEkspedisiTable($idEkspedisi);

        exit;
    }

    public function check() {
        $this->model('Ekspedisi_model')->checkEkspedisiTable();
    }
}