<?php

class Mahasiswa {
    private $table = 'mahasiswa';
    private $db;

    public function __construct() {
        // Mengambil koneksi database PDO dari Core System
        $this->db = Database::getConnection();
    }

    // Fungsi untuk mengambil semua data mahasiswa sorted by terbaru
    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Mengembalikan semua baris data sebagai array
    }
    //memanggil statistik
   public function getStatistik()
    {
        $query = "SELECT 
                    COUNT(*) AS total,
                    SUM(CASE WHEN jenis_kelamin = 'Laki-laki' THEN 1 ELSE 0 END) AS laki_laki,
                    SUM(CASE WHEN jenis_kelamin = 'Perempuan' THEN 1 ELSE 0 END) AS perempuan,
                    SUM(CASE WHEN status_id = 1 THEN 1 ELSE 0 END) AS aktif
                FROM " . $this->table;

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk mengecek apakah NPM sudah terdaftar
    public function cekNpm($npm) {
        $query = "SELECT id FROM " . $this->table . " WHERE npm = :npm";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':npm', $npm);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Fungsi untuk memasukkan data baru ke database
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " (npm, nama_lengkap, fakultas, jurusan, tempat_lahir, tanggal_lahir, jenis_kelamin, status_id) VALUES (:npm, :nama_lengkap, :fakultas, :jurusan, :tempat_lahir, :tanggal_lahir, :jenis_kelamin, 1)";
        
        $stmt = $this->db->prepare($query);
        
        // Binding data dengan aman untuk mencegah SQL Injection
        $stmt->bindValue(':npm', $data['npm']);
        $stmt->bindValue(':nama_lengkap', $data['nama_lengkap']);
        $stmt->bindValue(':fakultas', $data['fakultas']);
        $stmt->bindValue(':jurusan', $data['jurusan']);
        $stmt->bindValue(':tempat_lahir', $data['tempat_lahir']);
        $stmt->bindValue(':tanggal_lahir', $data['tanggal_lahir']);
        $stmt->bindValue(':jenis_kelamin', $data['jenis_kelamin']);
        
        return $stmt->execute();
    }

    // Fungsi untuk mencari data mahasiswa berdasarkan ID (untuk pre-populate form edit)
    public function find($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk memperbarui data mahasiswa di database
    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " SET 
                    npm = :npm, 
                    nama_lengkap = :nama_lengkap, 
                    fakultas = :fakultas, 
                    jurusan = :jurusan, 
                    tempat_lahir = :tempat_lahir, 
                    tanggal_lahir = :tanggal_lahir, 
                    jenis_kelamin = :jenis_kelamin 
                  WHERE id = :id";
        
        $stmt = $this->db->prepare($query);
        
        $stmt->bindValue(':npm', $data['npm']);
        $stmt->bindValue(':nama_lengkap', $data['nama_lengkap']);
        $stmt->bindValue(':fakultas', $data['fakultas']);
        $stmt->bindValue(':jurusan', $data['jurusan']);
        $stmt->bindValue(':tempat_lahir', $data['tempat_lahir']);
        $stmt->bindValue(':tanggal_lahir', $data['tanggal_lahir']);
        $stmt->bindValue(':jenis_kelamin', $data['jenis_kelamin']);
        $stmt->bindValue(':id', $id);
        
        return $stmt->execute();
    }

    // Fungsi untuk menghapus data mahasiswa berdasarkan ID
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    //Search Flter

    // Fungsi untuk menyusun query pencarian dan filter secara dinamis
    public function searchAndFilter($search = '', $jurusan = '') {
        $query = "SELECT * FROM " . $this->table;
        $conditions = [];
        
        // Jika kolom pencarian diisi
        if (!empty($search)) {
            $conditions[] = "(npm LIKE :search OR nama_lengkap LIKE :search)";
        }
        
        // Jika filter jurusan dipilih
        if (!empty($jurusan)) {
            $conditions[] = "jurusan = :jurusan";
        }
        
        // Gabungkan kondisi jika ada filter yang aktif
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }
        
        $query .= " ORDER BY id DESC";
        
        $stmt = $this->db->prepare($query);
        
        // Bind nilai parameter secara aman
        if (!empty($search)) {
            $stmt->bindValue(':search', '%' . $search . '%');
        }
        if (!empty($jurusan)) {
            $stmt->bindValue(':jurusan', $jurusan);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}