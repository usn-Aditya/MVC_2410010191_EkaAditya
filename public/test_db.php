<?php
require_once '../config/database.php';

try {
    $db = getConnection();
    if ($db) {
        echo "<h1>Koneksi berhasil!</h1>";
        echo "<p>Aplikasi web Anda sukses terhubung ke database <strong>uniska_latihan_mvc_2026</strong> menggunakan PDO.</p>";
    }
} catch (Exception $e) {
    echo "<h1>Koneksi Gagal:</h1> " . $e->getMessage();
} 