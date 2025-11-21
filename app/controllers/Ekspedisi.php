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
        
        // Buat dropdown List Ekspedisi (pada fitur Ubah, dropdown Ganti Ekspedisi)
        $data['semuaEkspedisi'] = $ekspedisiModel->getAllEkspedisi();

        $this->view('templates/header', $data);
        $this->view('ekspedisi/detail', $data);
        $this->view('templates/footer');
    }

    public function tambahJenisEkspedisi() {
        try {
            // DEBUG: Lihat semua data POST
            error_log('=== DEBUG TAMBAH JENIS EKSPEDISI ===');
            error_log('POST Data: ' . print_r($_POST, true));
            error_log('idEkspedisi: ' . ($_POST['ekspedisi'] ?? 'NOT FOUND'));
            error_log('======================================');

            // Get idEkspedisi from POST data for redirect
            $idEkspedisi = $_POST['idEkspedisi'] ?? $_POST['idEkspedisiModal'] ?? null;
            
            if(!$idEkspedisi) {
                error_log("ERROR: idEkspedisi is still null!");
                // Fallback: coba dari URL atau session
                $idEkspedisi = $this->getEkspedisiIdFromContext();

                // If still null, redirect to main page
                if(!$idEkspedisi) {
                    header('Location: ' . BASEURL . '/ekspedisi');
                    exit;
                }
            }

            if($this->model('Ekspedisi_model')->tambahDataJenisEkspedisi($_POST) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . '/ekspedisi/detail/' . $idEkspedisi);
                // Redirect back to the detail page instead of index
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                header('Location: ' . BASEURL . '/ekspedisi/detail/' . $idEkspedisi);
                // Redirect back to detail page or index
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
        $result = $this->model('Ekspedisi_model')->getJenisEkspedisiById($_POST['idJenisEkspedisi']);
        echo json_encode($result);
        // echo json_encode($this->model('Ekspedisi_model')->getJenisEkspedisiById($_POST['id']));
    }

    // Create Separate GET Endpoint for Fetching Data
    public function getDataJenisEkspedisi() {
        $data = $this->model('Ekspedisi_model')->getJenisEkspedisiById($_POST['idJenisEkspedisi']);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    // Create a method for dropdown if the ubahDataJenisEkspedisi method model ekspedisi not work 
    public function getIdEkspedisi() {
        // Check if parameter exists
        if(!isset($_POST['idJenisEkspedisi']) || empty($_POST['idJenisEkspedisi'])) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'error' => 'idJenisEkspedisi parameter missing or empty',
                'recieved' => 'POST'
            ]);
            exit;
        }

        $idEkspedisi = $this->model('Ekspedisi_model')->getIdEkspedisiByJenisEkspedisi($_POST['idJenisEkspedisi']);

        header('Content-Type: application/json');
        
        echo json_encode([
            'success' => true,
            'idEkspedisi' => $idEkspedisi,
            'searchedFor' => $_POST['idJenisEkspedisi'] // Untuk debug
        ]);
        exit;
    }

    // Update Pindah Ekspedisi after make changes in Dropdown
    public function pindahJenisEkspedisi() {
        // Validate required parameters
        if(!isset($_POST['idJenisEkspedisi']) && !isset($_POST['idEkspedisiBaru'])) {
            Flasher::setFlash('gagal', 'dipindah - data tidak lengkap', 'danger');
            header('Location: ' . BASEURL . '/ekspedisi');
            exit;
        }

        $idJenisEkspedisi = $_POST['idJenisEkspedisi'];
        $idEkspedisiBaru = $_POST['idEkspedisiBaru']; 
        $idEkspedisiLama = $_POST['idEkspedisi']; // Current Ekspedisi

        if($this->model('Ekspedisi_model')->ubahDataJenisEkspedisi($idJenisEkspedisi, $idEkspedisiBaru)) {
            Flasher::setFlash('berhasil', 'dipindah', 'success');
            header('Location: ' . BASEURL . '/ekspedisi/detail/' . $idEkspedisiBaru);
        } else {
            Flasher::setFlash('gagal', 'dipindah', 'danger');
            header('Location: ' . BASEURL . '/ekspedisi/detail/' . $idEkspedisiLama);
        }
        exit;
    }

    // Add this method to get ekspedisi data for dropdown
    public function getIdEkspedisiDropdown() {
        $idJenisEkspedisi = $_POST['idJenisEkspedisi'];
        $idEkspedisi = $this->model('Ekspedisi_model')->getIdEkspedisiByJenisEkspedisi($idJenisEkspedisi);
        
        echo(json_encode(['idEkspedisi' => $idEkspedisi]));
    }

    // 

    // Test sementara error idJenisEkspedisi, dan retest jika idJenisEkspedisi terhubung dengan idEkspedisi
    public function testGetIdEkspedisi() {
        // Test dengan ID yang pasti ada
        $idJenisEkspedisi_fkLayananEkspedisi = [3,4,5,6,20,21,22,33,44,55];

        foreach($idJenisEkspedisi_fkLayananEkspedisi as $id) {
            $result = $this->model('Ekspedisi_model')->getIdEkspedisiByJenisEkspedisi($id);
            echo "ID Jenis Ekspedisi: $id, ID Ekspedisi: " . ($result ? $result : 'NOT FOUND') . "<br>";
        }
        exit;
    }

    // This is for Update the data changes
    public function ubahJenisEkspedisi() {
        // Definisikan $idEkspedisi di luar blok if-else
        $idEkspedisi = $_POST['idEkspedisi'] ?? 'null';

        if(!$idEkspedisi) {
            $idEkspedisi = $this->getEkspedisiIdFromContext();
        }

        // $redirectURL = !empty($idEkspedisi)
        //     ? BASEURL . '/ekspedisi/detail/' . $idEkspedisi
        //     : BASEURL . '/ekspedisi';

        // Debug yang diterima:
        error_log('=== DATA DITERIMA DI CONTROLLER ===');
        error_log('idEkspedisi: ' . $idEkspedisi);
        error_log('id: ' . ($_POST['id'] ?? 'NOT SET'));
        error_log('jenisEkspedisi: ' . ($_POST['jenisEkspedisi'] ?? 'NOT SET'));
        error_log('deskripsi: ' . ($_POST['deskrispi'] ?? 'NOT SET'));

        $result = $this->model('Ekspedisi_model')->ubahDataJenisEkspedisi($_POST);

        error_log('=== HASIL UPDATE ===');
        error_log('Return value dari model: ' . $result);
        error_log('Tipe data: ' . gettype($result));

        //error_log('Update Result: ' . $result);

        if($result > 0) {
            error_log("SUCCESS: Data Updated");
            Flasher::setFlash('berhasil','diubah','success');
            header('Location: '. BASEURL . '/ekspedisi/detail/' . $idEkspedisi);

            // $idEkspedisi = $_POST['idEkspedisi'];
            // if(!empty($idEkspedisi)) {
            //     header('Location: ' . BASEURL . '/ekspedisi/detail/' . $idEkspedisi);
            // } else {
            //     header('Location: ' . BASEURL . '/ekspedisi');
            // }
            exit;
        } else {
            error_log("FAILED: No rows updated - Return Value: " . $result);
            Flasher::setFlash('gagal','diubah','danger');
            header('Location: ' . BASEURL . '/ekspedisi/detail/' . $idEkspedisi);
            // if(!empty($idEkspedisi)) {
            //     header('Location: ' . BASEURL . '/ekspedisi/detail/' . $idEkspedisi);
            // } else {
            //     header('Location: ' . BASEURL . '/ekspedisi');
            // }
            exit; 
        }

        header('Location: ' . $redirectURL);
        exit;
    }

    private function getEkspedisiIdFromContext() {
        // Coba dari berbagai sumber
        return $_POST['idEkspedisiModal'] ??
                $_POST['idEkspedisi_fkLayananEkspedisi'] ??
                $_SESSION['current_ekspedisi_id'] ??
                1; // fallback ke ID default
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