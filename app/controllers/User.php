<?php

class User extends Controller {
    public function index($namaDepan = "Chris", $namaBelakang = "shuo", $email = "shuo@email.com", $username = "chrisshuo123", $password="k3p0yaa") {
        $data['judul'] = 'List User';
        $data['namaDepan'] = $namaDepan;
        $data['namaBelakang'] = $namaBelakang;
        $data['email'] = $email;
        $data['username'] = $username;
        $data['password'] = $password;
        echo "User/index";
        $this->view('templates/header', $data);
        $this->view('user/index', $data);
        $this->view('templates/footer');
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