<?php

class MahasiswaController extends Controller {
  public function index() {
        $data['judul'] = 'Daftar Mahasiswa';
        
        // Tangkap data parameter GET dari URL form pencarian
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $jurusan = isset($_GET['jurusan']) ? trim($_GET['jurusan']) : '';
        
        // Simpan ke array data agar nilainya bisa dipertahankan di form view
        $data['search_value'] = $search;
        $data['jurusan_value'] = $jurusan;
        
        // Jika ada filter atau kata kunci pencarian, panggil metode searchAndFilter
        if (!empty($search) || !empty($jurusan)) {
            $data['mhs'] = $this->model('Mahasiswa')->searchAndFilter($search, $jurusan);
        } else {
            // Jika kosong, tampilkan semua data seperti biasa
            $data['mhs'] = $this->model('Mahasiswa')->getAll();
        }
        
        $this->view('mahasiswa/index', $data);
    }

    // Menampilkan halaman form tambah data
    public function create() {
        $data['judul'] = 'Tambah Mahasiswa';
        $this->view('mahasiswa/create', $data);
    }

    // Memproses penyimpanan data dari form POST
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mhsModel = $this->model('Mahasiswa');
            
            // Validasi Input Dasar
            if (empty($_POST['npm']) || empty($_POST['nama_lengkap'])) {
                $this->setFlash('NPM dan Nama Lengkap tidak boleh kosong!', 'danger');
                header('Location: ' . BASEURL . '/mahasiswa/create');
                exit;
            }

            // Validasi NPM unik
            if ($mhsModel->cekNpm($_POST['npm'])) {
                $this->setFlash('NPM sudah terdaftar, gunakan NPM lain!', 'danger');
                header('Location: ' . BASEURL . '/mahasiswa/create');
                exit;
            }

            // Jalankan simpan jika validasi aman
            if ($mhsModel->create($_POST)) {
                $this->setFlash('Data mahasiswa berhasil ditambahkan!', 'success');
                header('Location: ' . BASEURL . '/mahasiswa');
                exit;
            } else {
                $this->setFlash('Gagal menambahkan data.', 'danger');
                header('Location: ' . BASEURL . '/mahasiswa/create');
                exit;
            }
        }
    }


    // Menampilkan halaman form edit berdasarkan ID yang dipilih
    public function edit($id) {
        $data['judul'] = 'Edit Data Mahasiswa';
        $data['mhs'] = $this->model('Mahasiswa')->find($id);
        
        if (!$data['mhs']) {
            $this->setFlash('Data mahasiswa tidak ditemukan!', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        }
        
        $this->view('mahasiswa/edit', $data);
    }

    // Memproses update data dari form edit
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mhsModel = $this->model('Mahasiswa');
            
            // Validasi input kosong
            if (empty($_POST['npm']) || empty($_POST['nama_lengkap'])) {
                $this->setFlash('NPM dan Nama tidak boleh kosong!', 'danger');
                header('Location: ' . BASEURL . '/mahasiswa/edit/' . $id);
                exit;
            }

            // Validasi NPM unik (hanya jika NPM diubah ke nilai lain)
            $oldData = $mhsModel->find($id);
            if ($_POST['npm'] != $oldData['npm'] && $mhsModel->cekNpm($_POST['npm'])) {
                $this->setFlash('NPM sudah digunakan oleh mahasiswa lain!', 'danger');
                header('Location: ' . BASEURL . '/mahasiswa/edit/' . $id);
                exit;
            }

            if ($mhsModel->update($id, $_POST)) {
                $this->setFlash('Data mahasiswa berhasil diperbarui!', 'success');
                header('Location: ' . BASEURL . '/mahasiswa');
                exit;
            } else {
                $this->setFlash('Gagal memperbarui data.', 'danger');
                header('Location: ' . BASEURL . '/mahasiswa/edit/' . $id);
                exit;
            }
        }
    }

    // Memproses penghapusan data mahasiswa
    public function delete($id) {
        if ($this->model('Mahasiswa')->delete($id)) {
            $this->setFlash('Data mahasiswa berhasil dihapus!', 'success');
        } else {
            $this->setFlash('Gagal menghapus data mahasiswa.', 'danger');
        }
        header('Location: ' . BASEURL . '/mahasiswa');
        exit;
    }

    public function exportPdf() {
        // 1. Ambil data mahasiswa dari model
        $data['mhs'] = $this->model('Mahasiswa')->getAll();
        
        // 2. Panggil library Dompdf secara manual
        // Sesuaikan jalur path ini dengan lokasi folder dompdf di proyekmu
        require_once '../app/vendor/dompdf/autoload.inc.php';
        
        // Gunakan namespace Dompdf
        $dompdf = new Dompdf\Dompdf();
        
        // 3. Desain halaman PDF menggunakan HTML & CSS murni
        // Catatan: Dompdf lebih stabil menggunakan CSS inline/internal biasa daripada Bootstrap CDN
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Laporan Data Mahasiswa</title>
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; }
                .text-center { text-align: center; }
                .mb-4 { margin-bottom: 20px; }
                table { width: 100%; border-collapse: collapse; margin-top: 15px; }
                table, th, td { border: 1px solid #333; }
                th, td { padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; font-weight: bold; }
            </style>
        </head>
        <body>
            <h2 class="text-center">LAPORAN DATA MAHASISWA</h2>
            <h4 class="text-center mb-4">SISTEM INFORMASI AKADEMIK MVC</h4>
            <hr>';
            
        $html .= '<table>
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 15%;">NPM</th>
                            <th>Nama Lengkap</th>
                            <th>Fakultas</th>
                            <th>Jurusan</th>
                            <th>Jenis Kelamin</th>
                        </tr>
                    </thead>
                    <tbody>';
        
        $no = 1;
        foreach ($data['mhs'] as $mhs) {
            $html .= '<tr>
                        <td class="text-center">' . $no++ . '</td>
                        <td>' . $mhs['npm'] . '</td>
                        <td>' . $mhs['nama_lengkap'] . '</td>
                        <td>' . $mhs['fakultas'] . '</td>
                        <td>' . $mhs['jurusan'] . '</td>
                        <td>' . $mhs['jenis_kelamin'] . '</td>
                      </tr>';
        }
        
        $html .= '</tbody>
                </table>
        </body>
        </html>';
        
        // 4. Proses rendering HTML ke PDF
        $dompdf->loadHtml($html);
        
        // Atur ukuran kertas (A4) dan orientasi (Potrait/Landscape)
        $dompdf->setPaper('A4', 'portrait');
        
        // Render sebagai PDF
        $dompdf->render();
        
        // Output PDF ke browser dengan nama file tertentu (Attachment: false agar preview dulu, true untuk langsung download)
        $dompdf->stream("laporan_mahasiswa_" . date('Y-m-d') . ".pdf", array("Attachment" => false));
    }

    
}