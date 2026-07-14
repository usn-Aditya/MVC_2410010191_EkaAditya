<?php

class HomeController extends Controller {
    public function index() {
        $data['judul'] = 'Halaman Utama';
        //memanggil statistik
        $data['statistik'] = $this->model('Mahasiswa')->getStatistik();
        // Memanggil metode view dari Base Controller
        $this->view('home/index', $data);
    }
    
}
