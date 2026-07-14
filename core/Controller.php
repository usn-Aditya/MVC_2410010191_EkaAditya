<?php

class Controller {
    // 1. Metode untuk memanggil tampilan (view) dan mengirimkan data
    public function view($view, $data = []) {
        // Ekstrak data agar key array menjadi nama variabel tunggal
        extract($data);
        
        // Cek apakah file view utama ada
        if (file_exists('../app/views/' . $view . '.php')) {
            
            // Mulai menampung output halaman ke memori sementara
            ob_start();
            require_once '../app/views/' . $view . '.php';
            // Simpan hasil tampungan ke variabel $content, lalu bersihkan buffer
            $content = ob_get_clean();
            
            // Gabungkan secara otomatis dengan file layout utama
            if (file_exists('../app/views/layouts/header.php') && file_exists('../app/views/layouts/footer.php')) {
                require_once '../app/views/layouts/header.php';
                echo $content; // Tampilkan konten asli view di tengah
                require_once '../app/views/layouts/footer.php';
            } else {
                // Jalur cadangan jika file layout tidak ditemukan
                echo $content;
            }
            
        } else {
            die("View $view tidak ditemukan.");
        }
    }

    // 2. Metode untuk memanggil model
    public function model($model) {
        if (file_exists('../app/models/' . $model . '.php')) {
            require_once '../app/models/' . $model . '.php';
            return new $model();
        } else {
            die("Model $model tidak ditemukan.");
        }
    }

    // 3. Fungsi untuk mengatur pesan flash
    public function setFlash($pesan, $tipe) {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'tipe'  => $tipe
        ];
    }

    // 4. Fungsi untuk menampilkan pesan flash
    public function flash() {
        if (isset($_SESSION['flash'])) {
            echo '<div style="padding: 10px; margin-bottom: 15px; background-color: ' . ($_SESSION['flash']['tipe'] == 'success' ? '#d4edda' : '#f8d7da') . '; color: ' . ($_SESSION['flash']['tipe'] == 'success' ? '#155724' : '#721c24') . '; border: 1px solid ' . ($_SESSION['flash']['tipe'] == 'success' ? '#c3e6cb' : '#f5c6cb') . '; border-radius: 4px;">' . $_SESSION['flash']['pesan'] . '</div>';
            unset($_SESSION['flash']);
        }
    }
}