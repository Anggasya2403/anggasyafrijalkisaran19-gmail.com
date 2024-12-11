<?php
// Menghubungkan ke database
include('koneksi.php');

// Mengecek apakah tombol ekspor CSV atau Excel yang ditekan
if (isset($_POST['ekspor_csv'])) {
    // Menyiapkan header untuk file CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="zakat.csv"');

    // Membuka file output ke browser
    $output = fopen('php://output', 'w');

    // Menulis header kolom CSV
    fputcsv($output, ['Nama', 'Jenis', 'Jumlah', 'Tanggal']);

    // Query untuk mengambil semua data zakat
    $sql = "SELECT * FROM zakat ORDER BY tanggal DESC";
    $result = $conn->query($sql);

    // Menulis data zakat ke file CSV
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            $row['nama'], 
            $row['jenis'], 
            $row['jumlah'], 
            $row['tanggal']
        ]);
    }

    // Menutup file output
    fclose($output);
} 
// Ekspor ke Excel jika tombol Excel yang ditekan
else if (isset($_POST['ekspor_excel'])) {
    // Menyiapkan header untuk file Excel
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="zakat.xls"');

    // Membuka file output ke browser
    $output = fopen('php://output', 'w');

    // Menulis header kolom Excel
    fputcsv($output, ['Nama', 'Jenis', 'Jumlah', 'Tanggal']);

    // Query untuk mengambil semua data zakat
    $sql = "SELECT * FROM zakat ORDER BY tanggal DESC";
    $result = $conn->query($sql);

    // Menulis data zakat ke file Excel
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            $row['nama'], 
            $row['jenis'], 
            $row['jumlah'], 
            $row['tanggal']
        ]);
    }

    // Menutup file output
    fclose($output);
}

// Menutup koneksi
$conn->close();
?>
