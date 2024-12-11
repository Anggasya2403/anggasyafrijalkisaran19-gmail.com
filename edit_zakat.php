<?php
// Menghubungkan ke database
include('koneksi.php');

// Mengecek apakah ada ID yang dikirimkan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data zakat yang akan diedit
    $sql = "SELECT * FROM zakat WHERE id = $id";
    $result = $conn->query($sql);

    // Jika data ditemukan, tampilkan form
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }
} else {
    echo "ID tidak ditemukan.";
    exit();
}

// Mengecek apakah formulir telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    // Menyiapkan query untuk update data zakat
    $sql = "UPDATE zakat SET nama='$nama', jenis='$jenis', jumlah='$jumlah', tanggal='$tanggal' WHERE id=$id";

    // Mengeksekusi query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil diupdate'); window.location.href='index.php';</script>";
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
    <title>Edit Zakat</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>Edit Data Zakat</h1>
    <nav>
        <a href="index.php">Kembali ke Daftar Zakat</a>
    </nav>
</header>

<div class="container">
    <form method="POST" action="">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required>

        <label for="jenis">Jenis Zakat:</label>
        <select id="jenis" name="jenis" required>
            <option value="Zakat Fitrah" <?php echo ($row['jenis'] == 'Zakat Fitrah') ? 'selected' : ''; ?>>Zakat Fitrah</option>
            <option value="Zakat Mal" <?php echo ($row['jenis'] == 'Zakat Mal') ? 'selected' : ''; ?>>Zakat Mal</option>
            <option value="Zakat Perdagangan" <?php echo ($row['jenis'] == 'Zakat Perdagangan') ? 'selected' : ''; ?>>Zakat Perdagangan</option>
            <option value="Zakat Pertanian" <?php echo ($row['jenis'] == 'Zakat Pertanian') ? 'selected' : ''; ?>>Zakat Pertanian</option>
        </select>

        <label for="jumlah">Jumlah:</label>
        <input type="number" id="jumlah" name="jumlah" value="<?php echo $row['jumlah']; ?>" required>

        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>

        <button type="submit">Update Zakat</button>
    </form>
</div>

<footer>
    <p>&copy; Sistem Informasi Zakat. </p>
</footer>

</body>
</html>
