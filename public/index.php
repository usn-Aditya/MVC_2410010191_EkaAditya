<?php
// Memulai session aplikasi
if (!isset($_SESSION)) {
    session_start();
}

// Definisikan konstanta BASEURL
define('BASEURL', 'http://localhost/mvc_mahasiswa/public');

// Autoload manual untuk file Core System
require_once '../core/Router.php';
require_once '../core/Controller.php';
require_once '../core/Database.php';

// Jalankan aplikasi dengan menginstansiasi Router
$app = new Router();