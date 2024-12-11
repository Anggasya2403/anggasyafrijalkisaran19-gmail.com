<?php
// Menghubungkan ke database
include('koneksi.php');

// Mengecek apakah formulir telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    // Menyiapkan query untuk menyimpan data
    $sql = "INSERT INTO zakat (nama, jenis, jumlah, tanggal) 
            VALUES ('$nama', '$jenis', '$jumlah', '$tanggal')";

    // Mengeksekusi query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil disimpan');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Zakat</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="bg-primary text-white py-3">
    <div class="container text-center">
        <h1>Tambah Data Zakat Masjid Al-Husna</h1>
        <nav>
            <a href="index.php" class="btn btn-light btn-sm">Kembali ke Daftar Zakat</a>
        </nav>
    </div>
</header>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="text-center">Form Tambah Data Zakat</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis Zakat</label>
                    <select id="jenis" name="jenis" class="form-select" required>
                        <option value="Zakat Fitrah">Zakat Fitrah</option>
                        <option value="Zakat Mal">Zakat Mal</option>
                        <option value="Zakat Perdagangan">Zakat Perdagangan</option>
                        <option value="Zakat Pertanian">Zakat Pertanian</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Tambah Zakat</button>
                </div>
            </form>
        </div>
    </div>
</div>

<footer class="bg-primary text-white text-center py-3 mt-5">
    <p>Sistem Informasi Zakat Masjid Al-Husna.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
