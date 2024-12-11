<?php
// Mulai sesi
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}

// Menghubungkan ke database
include('koneksi.php');

// Mendapatkan data pengguna yang login
$user_id = $_SESSION['users']['id'];
$sql_user = "SELECT * FROM users WHERE id = $user_id";
$result_user = $conn->query($sql_user);
$user_data = $result_user->fetch_assoc();

// Query untuk mengambil semua data zakat
$sql = "SELECT * FROM zakat ORDER BY tanggal DESC";
$result = $conn->query($sql);

// Query untuk menghitung total zakat
$total_sql = "SELECT SUM(jumlah) AS total_zakat FROM zakat";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_zakat = $total_row['total_zakat'];

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Zakat Masjid Al-Husna</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="bg-primary text-white py-3">
    <div class="container">
        <h1 class="text-center">Daftar Zakat Masjid Al-Husna</h1>
        <nav class="text-center">
            <!-- Menampilkan nama pengguna yang login -->
            <span class="badge bg-light text-dark">Selamat Datang Di Sizakat, <?php echo htmlspecialchars($user_data['username']); ?></span>
            <a href="add_zakat.php" class="btn btn-light btn-sm">Tambah Zakat</a>
            <a href="add_mustahik.php" class="btn btn-light btn-sm">Tambah Data Mustahaq</a>
            <a href="list_mustahik.php" class="btn btn-light btn-sm">Daftar Data Mustahaq</a>
            <a href="logout.php" class="btn btn-secondary btn-sm">Logout</a>
        </nav>
    </div>
</header>

<div class="container mt-5">
    <form method="POST" action="ekspor_zakat.php" class="mb-3">
        <button type="submit" name="ekspor_csv" class="btn btn-success">Ekspor CSV</button>
        <button type="submit" name="ekspor_excel" class="btn btn-success">Ekspor Excel</button>
    </form>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Tanggal Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['jenis']); ?></td>
                            <td>Rp <?php echo number_format($row['jumlah'], 2, ',', '.'); ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="edit_zakat.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <!-- Tombol Hapus -->
                                <a href="hapus_zakat.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div class="alert alert-info mt-3">
            <h3>Total Zakat: Rp <?php echo number_format($total_zakat, 2, ',', '.'); ?></h3>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">Belum ada data zakat yang dimasukkan.</div>
    <?php endif; ?>
</div>

<!-- Profil Pengguna -->
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-black">
            <h5>Profil Pengguna Website</h5>
        </div>
        <div class="card-body">
            <p><strong>Nama:</strong> <?php echo htmlspecialchars($user_data['username']); ?></p>
            <p><strong>Status:</strong> <?php echo htmlspecialchars($user_data['role']); ?></p>
            
        </div>
    </div>
</div>

<footer class="bg-primary text-white text-center py-3 mt-5">
    <p>Sistem Informasi Zakat Masjid Al-Husna</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
