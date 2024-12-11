<?php
session_start();
include('koneksi.php');

// Pastikan pengguna sudah login
if (!isset($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}

// Ambil ID mustahik dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data mustahik berdasarkan ID
$result_mustahik = $conn->query("SELECT * FROM mustahik WHERE id = $id");
$mustahik = $result_mustahik->fetch_assoc();

if (!$mustahik) {
    echo "Data mustahik tidak ditemukan.";
    exit();
}

// Hitung jumlah zakat keseluruhan
$result_zakat = $conn->query("SELECT SUM(jumlah) AS total_zakat FROM zakat");
$data_zakat = $result_zakat->fetch_assoc();
$total_zakat = $data_zakat['total_zakat'] ?? 0;

// Hitung jumlah mustahik
$result_total_mustahik = $conn->query("SELECT COUNT(*) AS total_mustahik FROM mustahik");
$data_mustahik = $result_total_mustahik->fetch_assoc();
$jumlah_mustahik = $data_mustahik['total_mustahik'] ?? 1;

// Hitung zakat yang diterima
$rata_rata = $total_zakat / $jumlah_mustahik;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Distribusi Zakat</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="display-6 text-primary">Kwitansi Distribusi Zakat</h1>
            <hr class="border border-primary border-2 opacity-50">
        </div>

        <!-- Kwitansi -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Penyerahan Zakat Dari Masjid Al-Husna</h4>
            </div>
            <div class="card-body">
                <p><strong>Nama Mustahaq:</strong> <?php echo htmlspecialchars($mustahik['nama']); ?></p>
                <p><strong>Alamat Mustahaq:</strong> <?php echo htmlspecialchars($mustahik['alamat']); ?></p>
                <p><strong>Zakat yang Diterima:</strong> Rp <?php echo number_format($rata_rata, 2, ',', '.'); ?></p>
                <p><strong>Penyerahan:</strong> <?php echo date('l, d F Y'); ?></p>
                <p><strong>Tanda Terima:</strong></p>
                <div class="mt-5 text-center">
                    <p>__________________________</p>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-4 d-flex justify-content-center gap-3">
            <button class="btn btn-success" onclick="window.print()">Cetak Kwitansi</button>
            <a href="list_mustahik.php" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5 py-3 bg-primary text-white">
        <p class="mb-0">Sistem Informasi Zakat Masjid Al-Husna</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
