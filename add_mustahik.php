<?php
session_start();
include('koneksi.php');

// Pastikan pengguna sudah login
if (!isset($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}

// Proses penambahan mustahik
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kategori = $_POST['kategori'];
    $tanggal = $_POST['tanggal'];

    $stmt = $conn->prepare("INSERT INTO mustahik (nama, alamat, kategori, tanggal) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $alamat, $kategori, $tanggal);

    if ($stmt->execute()) {
        $success = "Data mustahik berhasil ditambahkan.";
    } else {
        $error = "Gagal menambahkan data mustahik.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mustahaq - Sistem Informasi Zakat</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="bg-primary text-white text-center py-3">
    <h1>Tambah Data Mustahaq</h1>
</header>

<div class="container mt-5">
    <!-- Notifikasi -->
    <?php if (isset($success)): ?>
        <div class="alert alert-success text-center"><?php echo $success; ?></div>
    <?php elseif (isset($error)): ?>
        <div class="alert alert-danger text-center"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Form -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="text-center">Form Tambah Mustahaq</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama mustahaq" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Masukkan alamat" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-select" required>
                        <option value="Fakir">Fakir</option>
                        <option value="Miskin">Miskin</option>
                        <option value="Amil">Amil</option>
                        <option value="Mualaf">Mualaf</option>
                        <option value="Riqab">Riqab</option>
                        <option value="Gharim">Gharim</option>
                        <option value="Fisabilillah">Fisabilillah</option>
                        <option value="Ibnu Sabil">Ibnu Sabil</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Tambah Mustahaq</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Navigasi -->
    <div class="mt-4 text-center">
        <a href="index.php" class="btn btn-secondary">Kembali ke Dashboard</a>
        <a href="list_mustahik.php" class="btn btn-info text-white">Lihat Data Mustahaq</a>
    </div>
</div>

<footer class="bg-primary text-white text-center py-3 mt-5">
    <p>Sistem Informasi Zakat Masjid Al-Husna</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
