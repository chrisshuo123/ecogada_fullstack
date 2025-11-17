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

    // public function detail($idEkspedisi) {
        // Karena didalam tag div class .container tidak menampilkan apa2, berarti ini masalah serius
        // Aktifkan error reporting dgn Echo test 1 sampai 5 lalu flush
        // error_reporting(E_ALL);
        // ini_set('display_errors', 1);

        // echo "TEST 1: Masuk method detail<br>";
        // flush();

        // $namaEkspedisi = $this->model('Ekspedisi_model')->getNamaEkspedisi($idEkspedisi);
        // echo "TEST 2: Nama Ekspedisi: $namaEkspedisi<br>";
        // Get semua layanan (jenis_ekspedisi) yang terkait dengan ekspedisi ini
        // $data['jenisEkspedisi'] = $this->model('Ekspedisi_model')->getJenisEkspedisi_By_IdEkspedisi($idEkspedisi);
        // $data['foto'] = $this->model('Foto_model')->getFotoEkspedisiById($idEkspedisi);
        // echo "TEST 3: Data Jumlah Jenis Ekspedisi: " . count($data['jenisEkspedisi']) . "<br>";
        // flush();
        
        // Debug menampilkan nama Ekspedisi (debug sebelumnya)
        // echo "Nama Ekspedisi yang didapat: ";
        // var_dump($namaEkspedisi);
        // echo "IdEkspedisi yang didapat: ";
        // var_dump($idEkspedisi);
        // exit;

        // Jika tidak ada data, redirect ke list:
        // if (empty($data['ekspedisi'])) {
        //     header('location: ' . BASEURL . '/ekspedisi');
        //     echo "<script type='text/javascript'>alert('Data ekspedisi kosong');</script>";
        //     exit;
        // }

        // $data['judul'] = "Detail " . $namaEkspedisi;
        // Judul pada halaman detail per ekspedisi (yg diatas untuk header):
        // $data['judul_ekspedisi'] = $namaEkspedisi;
        
        // echo "TEST 4: Sebelum load view<br>";
        // flush();

        // try {
        //     echo "TEST 4.1: Sebelum templates/header";
        //     $this->view('templates/header', $data);
        //     echo "TEST 4.2: Sesudah templates/header, sebelum ekspedisi/detail";
        //     $this->view('ekspedisi/detail', $data);
        //     echo "TEST 4.3: Sesudah ekspedisi/detail, sebelum templates/footer";
        //     $this->view('templates/footer');
        //     echo "TEST 4.4: Sesudah templates/footer, dan diatas-atasnya";
        // } catch(Exception $e) {
        //     echo "Error in view: " . $e->getMessage() . "<br>";
        // }
        
        // $this->view('templates/header', $data);
        // $this->view('ekspedisi/detail', $data);
        // $this->view('templates/footer');
        // echo "TEST 5: Setelah load view<br>";
        // flush();
    // }

    public function detail($idEkspedisi) {
        // Pengembalian Nama Page Header dan Judul disini
        $namaEkspedisi = $this->model('Ekspedisi_model')->getNamaEkspedisi($idEkspedisi);
        $data['judul'] = "Detail " . $namaEkspedisi;
        $data['judul_ekspedisi'] = $namaEkspedisi;

        // echo 'Nama Ekspedisi di Header: ', $data['judul'];
        // echo 'Nama Ekspedisi di Judul: ', $data['judul_ekspedisi'];

        // Instantiate variabel dari ekspedisi model, dan foto model
        $ekspedisiModel = $this->model('Ekspedisi_model');
        $fotoModel = $this->model('Foto_model');

        // Ambil data ekspedisi
        $data['ekspedisi'] = $ekspedisiModel->getJenisEkspedisi_By_IdEkspedisi($idEkspedisi);
        // Ambil data foto
        $fotoData = $fotoModel->getFotoEkspedisiById($idEkspedisi);

        // Bagi Foto: Convert to base64 untuk langsung di embed di img src
        if($fotoData && !empty($fotoData['fotoEkspedisi'])) {
            $base64 = base64_encode($fotoData['fotoEkspedisi']);
            $data['fotoBase64'] = "data:image/jpeg;base64," . $base64;
        } else {
            // Default image path - sesuaikan dengan struktur folder anda
            $defaultPath = 'public/img/default-ekspedisi.png';
            if(file_exists($defaultPath)) {
                $defaultData = base64_encode(file_get_contents($defaultPath));
                $data['fotoBase64'] = "data:image/png;base64," . $defaultData;
            } else {
                // Fallback hardcoded default
                $data['fotoBase64'] = BASEURL . "/img/default-ekspedisi.png";
            }
        }

        // Data untuk view
        // $data['judul_ekspedisi'] = $data['ekspedisi']['judulEkspedisi'] ?? 'Ekspedisi';
        $data['judul_ekspedisi'] = $namaEkspedisi ?? 'Ekspedisi';
        
        $data['jenisEkspedisi'] = $ekspedisiModel->getJenisEkspedisi_By_IdEkspedisi($idEkspedisi);
        $data['idEkspedisi'] = $idEkspedisi;
        
        $this->view('templates/header', $data);
        $this->view('ekspedisi/detail', $data);
        $this->view('templates/footer');
    }

    public function tambahJenisEkspedisi() {
        try {
            // Get idEkspedisi from POST data for redirect
            $idEkspedisi = $_POST['idEkspedisi'];

            if($this->model('Ekspedisi_model')->tambahDataJenisEkspedisi($_POST) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');

                // Redirect back to the detail page instead of index
                if(!empty($idEkspedisi)) {
                    header('Location: ' . BASEURL . '/ekspedisi/detail/' . $idEkspedisi);
                } else {
                    header('Location: ' . BASEURL . '/ekspedisi');
                }
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                
                // Redirect back to detail page or index
                if(!empty($idEkspedisi)) {
                    header('Location: ' . BASEURL . '/ekspedisi/detail/' . $idEkspedisi);
                } else {
                    header('Location: ' . BASEURL . '/ekspedisi');
                }
                exit;
            }
        } catch(PDOException $e) {
            // Check if it's a duplicate entry error (code 23000 and 1062)
            if($e->getCode() == '23000' && strpos($e->getMessage(), '1062') != false) {
                Flasher::setFlash('gagal', 'ditambahkan - Jenis Ekspedisi sudah Terdaftar!', 'danger');
            } else {
                Flasher::setFlash('gagal', 'ditambahkan - Update DB Failed', 'danger');
            }

            // Redirect back to detail page or index
            if(!empty($idEkspedisi)) {
                header('Location: ' . BASEURL . '/ekspedisi/detail/' . $idEkspedisi);
            } else {
                header('Location: ' . BASEURL . '/ekspedisi');
            }
            exit;
        }
    }

    public function hapusJenisEkspedisi($idJenisEkspedisi, $idEkspedisi = null) {
        // If idEkspedisi is not passed as parameter, get it from somewhere else
        // or you might need to adjust your routing
        
        if ($this->model('Ekspedisi_model')->hapusDataJenisEkspedisi($idJenisEkspedisi)) {
            Flasher::setFlash('berhasil','dihapus','success');
            
            if(!empty($idEkspedisi)) {
                header('Location: ' . BASEURL . '/ekspedisi/detail/' . $idEkspedisi);
            } else {
                header('Location: ' . BASEURL . '/ekspedisi');
            }
            exit;
        } else {
            Flasher::setFlash('gagal','dihapus','danger');
            
            if(!empty($idEkspedisi)) {
                header('Location: ' . BASEURL . '/ekspedisi/detail/' . $idEkspedisi);
            } else {
                header('Location: ' . BASEURL . '/ekspedisi');
            }
            exit;
        }
    }

    public function getUbahJenisEkspedisi() {
        echo json_encode($this->model('Ekspedisi_model')->getJenisEkspedisiById($_POST['id']));
    }

    public function ubahJenisEkspedisi() {
        if($this->model('Ekspedisi_model')->ubahDataEkspedisi($_POST) > 0) {
            error_log("SUCCESS: Data Updated");
            Flasher::setFlash('berhasil','diubah','success');
            header('Location: ' . BASEURL . '/ekspedisi');
            exit;
        } else {
            error_log("FAILED: No rows updated");
            Flasher::setFlash('gagal','diubah','danger');
            header('Location: ' . BASEURL . '/ekspedisi');
            exit; 
        }
    }

    // Lakukan View Method langsung, ngedebug Test 1-5 Flush diatas ini
    public function testView() {
        echo "TEST VIEW METHOD START<br>";
        
        $data = ['judul' => 'Test Title'];
        
        try {
            $this->view('templates/header', $data);
            echo "HEADER SUCCESS<br>";
            
            $this->view('ekspedisi/detail', $data);
            echo "DETAIL SUCCESS<br>";
            
            $this->view('templates/footer', $data);
            echo "FOOTER SUCCESS<br>";
        } catch (Exception $e) {
            echo "VIEW ERROR: " . $e->getMessage() . "<br>";
        }
        
        echo "TEST VIEW METHOD END<br>";
        exit;
    } // Jalankan pakai http://localhost/ecogada_fullstack/public/ekspedisi/testView

    // Khusus testing halaman Ekspedisi/detail saja
    public function detail2() {
        $data['judul'] = "Halaman Detail Ekspedisi";
        $this->view('templates/header', $data);
        $this->view('ekspedisi/detail2');
        $this->view('templates/footer');
    }

    public function getUbah() {
        echo json_encode($this->model('Ekspedisi_model')->getEkspedisiById($_POST['id']));
    }

    // controllers/Ekspedisi.php Debugging
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