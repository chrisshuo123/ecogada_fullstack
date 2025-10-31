<?php

class User extends Controller {
    public function index($namaDepan = "Chris", $namaBelakang = "shuo", $email = "shuo@email.com", $username = "chrisshuo123", $password="k3p0yaa") {
        $data['judul'] = 'List User';
        $data['namaDepan'] = $namaDepan;
        $data['namaBelakang'] = $namaBelakang;
        $data['email'] = $email;
        $data['username'] = $username;
        $data['password'] = $password;
        $data['user'] = $this->model('User_model')->getAllUser();
        echo "User/index";
        $this->view('templates/header', $data);
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }

    public function detail($idUser) {
        $data['judul'] = 'Detail';
        $data['user'] = $this->model('User_model')->getUserById($idUser);
        echo "User/detail";
        $this->view('templates/header', $data);
        $this->view('user/detail',$data);
        $this->view('templates/footer');
    }

    public function tambah() {
        try {
            if($this->model('User_model')->tambahDataUser($_POST) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . '/user');
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                header('Location: ' . BASEURL . '/user');
                exit;
            }
        } catch(PDOException $e) {
            // Check if it's a duplicate entry error (code 23000 and 1062)
            if($e->getCode() == '23000' && strpos($e->getMessage(), '1062') != false) {
                Flasher::setFlash('gagal', 'ditambahkan - Email sudah Terdaftar!', 'danger');
            } else {
                Flasher::setFlash('gagal', 'ditambahkan - Update DB Failed', 'danger');
            }
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }

    public function hapus($idUser) {
        if ($this->model('User_model')->hapusDataUser($idUser) > 0) {
            Flasher::setFlash('berhasil','dihapus','success');
            header('Location: ' . BASEURL . '/user');
            exit;
        } else {
            Flasher::setFlash('gagal','dihapus','danger');
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }

    public function getUbah() {
        // $result = $this->model('User_model')->getUserById($_POST['idUser']);
        // echo json_encode($result);
        echo json_encode($this->model('User_model')->getUserById($_POST['id']));
    }

    public function ubah() {
        if($this->model('User_model')->ubahDataUser($_POST) > 0) {
            error_log("SUCCESS: Data Updated");
            Flasher::setFlash('berhasil','diubah','success');
            header('Location: ' . BASEURL . '/user');
            exit;
        } else {
            error_log("FAILED: No rows updated");
            Flasher::setFlash('gagal','diubah','danger');
            header('Location: ' . BASEURL . '/user');
            exit; 
        }
    }

    public function register($namaDepan = "Melani", $namaBelakang = "Pranawa", $email = "melani@email.com", $username = "melani", $password = "melani") {
        $data['judul'] = 'Register';
        $data['namaDepan'] = $namaDepan;
        $data['namaBelakang'] = $namaBelakang;
        $data['email'] = $email;
        $data['username'] = $username;
        $data['password'] = $password;
        echo "User/register";
        $this->view('templates/header', $data);
        $this->view('user/register', $data);
        $this->view('templates/footer');
    }
    public function login($username = "melani", $password = "melani") {
        $data['judul'] = 'Login';
        $data['username'] = $username;
        $data['password'] = $password;
        echo "User/login";
        $this->view('templates/header', $data);
        $this->view('user/login', $data);
        $this->view('templates/footer');
    }
}

?>