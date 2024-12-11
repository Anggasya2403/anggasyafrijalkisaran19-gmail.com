<?php
session_start();
include('koneksi.php');

// Pastikan pengguna sudah login
if (!isset($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}

// Ambil data mustahik
$result = $conn->query("SELECT * FROM mustahik ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mustahaq - Sistem Informasi Zakat</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="bg-primary text-white text-center py-3">
    <h1>Daftar Mustahaq</h1>
</header>

<div class="container mt-5">
    <!-- Tombol Tambah -->
    <div class="d-flex justify-content-between mb-3">
        <h2 class="text-primary">Data Mustahaq</h2>
        <a href="add_mustahik.php" class="btn btn-success">Tambah Mustahaq</a>
    </div>

    <!-- Tabel Data -->
    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                            <td><?php echo htmlspecialchars($row['kategori']); ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="edit_mustahik.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <!-- Tombol Hapus -->
                                <a href="hapus_mustahik.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                <!-- Tombol Distribusi -->
                                <a href="distribusi.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm text-white" onclick="return confirm('Distribusikan Sekarang?')">Distribusi</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">
            <p>Belum ada data mustahaq.</p>
        </div>
    <?php endif; ?>

    <!-- Tombol Kembali -->
    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</div>

<footer class="bg-primary text-white text-center py-3 mt-5">
    <p>Sistem Informasi Zakat Masjid Al-Husna</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
