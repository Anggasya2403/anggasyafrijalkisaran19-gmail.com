<?php
// Menghubungkan ke database
include('koneksi.php');

// Mengecek apakah ada ID yang dikirimkan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data mustahik yang akan diedit
    $sql = "SELECT * FROM mustahik WHERE id = $id";
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
    $alamat = $_POST['alamat'];
    $kategori = $_POST['kategori'];
    $tanggal = $_POST['tanggal'];

    // Menyiapkan query untuk update data zakat
    $sql = "UPDATE mustahik SET nama='$nama', alamat='$alamat', kategori='$kategori', tanggal='$tanggal' WHERE id=$id";

    // Mengeksekusi query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil diupdate'); window.location.href='list_mustahik.php';</script>";
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
    <title>Edit Mustahaq</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>Edit Data Mustahaq</h1>
    <nav>
        <a href="index.php">Kembali ke Daftar Data Mustahaq</a>
    </nav>
</header>

<div class="container">
<form method="POST" action="">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required>
        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" value="<?php echo htmlspecialchars($row['alamat']); ?>" required>

        <label for="kategori">kategori:</label>
        <select id="kategori" name="kategori" required>
            <option value="Fakir" <?php echo ($row['kategori'] == 'Fakir') ? 'selected' : ''; ?>>Fakir</option>
            <option value="Miskin" <?php echo ($row['kategori'] == 'Miskin') ? 'selected' : ''; ?>>Miskin</option>
            <option value="Amil" <?php echo ($row['kategori'] == 'Amil') ? 'selected' : ''; ?>>Amil</option>
            <option value="Mualaf" <?php echo ($row['kategori'] == 'Mualaf') ? 'selected' : ''; ?>>Mualaf</option>
            <option value="Riqap" <?php echo ($row['kategori'] == 'Riqap') ? 'selected' : ''; ?>>Riqap</option>
            <option value="Gharim" <?php echo ($row['kategori'] == 'Gharim') ? 'selected' : ''; ?>>Gharim</option>
            <option value="Fisabillah" <?php echo ($row['kategori'] == 'Fisabillah') ? 'selected' : ''; ?>>Fisabillah</option>
            <option value="Ibnu Sabil" <?php echo ($row['kategori'] == 'Ibnu Sabil') ? 'selected' : ''; ?>>Ibnu Sabil</option>
        </select>

        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>

        <button type="submit">Update Mustahaq</button>
    </form>
</div>

<footer>
    <p>Sistem Informasi Zakat Masjid Al-Husna </p>
</footer>

</body>
</html>
