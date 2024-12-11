<?php
session_start();
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mencari pengguna
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['users'] = $user;
            header("Location: index.php");
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Zakat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #4facfe, #00f2fe); /* Gradien biru menarik */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-container h1 {
            color: #5d5d5d;
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
            color: #333;
        }
        .form-control {
            border-radius: 30px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 15px;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .btn-custom:focus {
            outline: none;
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-bottom: 15px;
        }
        .form-control-icon {
            position: relative;
        }
        .form-control-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
        }
        .forgot-password {
            color: #007bff;
            text-decoration: none;
            font-size: 0.9em;
        }
        .forgot-password:hover {
            text-decoration: underline;
        }
        .register-link {
            margin-top: 10px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h1>Login Sizakat</h1>
        
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group form-control-icon">
                <i class="fas fa-user"></i>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>

            <div class="form-group form-control-icon">
                <i class="fas fa-lock"></i>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-custom btn-block">Login</button>
            
            
            
        </form>
    </div>

    <!-- Tambahkan font-awesome untuk ikon -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
