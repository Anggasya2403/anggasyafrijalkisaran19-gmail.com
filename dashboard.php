<?php
// Mulai sesi
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['users'])) {
    header('Location: login.php');
    exit();
}

// Mengambil data pengguna
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>Dashboard</h1>
    <nav>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<div class="container">
    <h2>Selamat datang, <?php echo htmlspecialchars($username); ?>!</h2>
    <p>Anda berhasil login ke Sistem Informasi Zakat.</p>
</div>

<footer>
    <p>&copy; Sistem Informasi Zakat</p>
</footer>

</body>
</html>
