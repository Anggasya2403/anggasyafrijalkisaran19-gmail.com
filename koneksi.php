<?php
$host = 'localhost'; // Ganti dengan host database Anda
$username = 'root';  // Ganti dengan username database Anda
$password = '';      // Ganti dengan password database Anda
$database = 'zakat_management'; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
