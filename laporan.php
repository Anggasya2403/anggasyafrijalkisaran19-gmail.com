<?php
session_start();
include 'config.php'; // Menghubungkan ke database

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];

    $sql = "SELECT * FROM zakat WHERE tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY tanggal DESC";
    $result = $conn->query($sql);
} else {
    $sql = "SELECT * FROM zakat ORDER BY tanggal DESC";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Zakat</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>Laporan Zakat</h1>
    <nav>
        <a href="index.php">Kembali ke Daftar Zakat</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<div class="container">
    <form method="POST" action="">
        <label for="tanggal_awal">Tanggal Awal:</label>
        <input type="date" id="tanggal_awal" name="tanggal_awal" required>

        <label for="tanggal_akhir">Tanggal Akhir:</label>
        <input type="date" id="tanggal_akhir" name="tanggal_akhir" required>

        <button type="submit">Tampilkan Laporan</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['jenis']}</td>
                            <td>{$row['jumlah']}</td>
                            <td>{$row['tanggal']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<footer>
    <p>&copy; 2023 Sistem Informasi Zakat. All Rights Reserved.</p>
</footer>

</body>
</html>