<?php
// Menghubungkan ke database
include('koneksi.php');

// Mengecek apakah ada ID yang dikirimkan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data zakat berdasarkan ID
    $sql = "DELETE FROM zakat WHERE id = $id";

    // Mengeksekusi query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan.";
}

// Menutup koneksi
$conn->close();
?>
