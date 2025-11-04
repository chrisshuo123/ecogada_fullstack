<?php

class Home extends Controller {
    public function index($nama = 'Melani') {
        echo 'home/index';
        $data['judul'] = "Home";
        $data['nama'] = $nama;
        $data['julukan'] = $this->model('Home_model')->getHome();
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}

?>