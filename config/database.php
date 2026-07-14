<?php
function getConnection() {
    $host = 'localhost';
    $dbname = 'uniska_latihan_mvc_2026';
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        // Set mode error PDO ke exception untuk mempermudah debugging
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Koneksi database gagal: " . $e->getMessage());
    }
}